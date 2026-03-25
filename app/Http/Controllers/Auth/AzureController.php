<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\PortalResolver;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AzureController extends Controller
{
    protected PortalResolver $portalResolver;

    public function __construct(PortalResolver $portalResolver)
    {
        $this->portalResolver = $portalResolver;
    }

    /**
     * Redirige al usuario a Azure AD para autorizar.
     */
    public function redirect(): RedirectResponse
    {
        $tenantId = config('azure.tenant_id');
        $clientId = config('azure.client_id');
        $redirectUri = config('azure.redirect_uri');

        if (! $tenantId || ! $clientId) {
            return redirect()->route('login')->withErrors(['error' => 'Configuración de Azure incompleta (AZURE_TENANT_ID, AZURE_CLIENT_ID).']);
        }

        $state = Str::random(32);
        session(['azure_state' => $state]);
        session()->save();

        $params = http_build_query([
            'client_id' => $clientId,
            'response_type' => 'code',
            'response_mode' => 'query',
            'redirect_uri' => $redirectUri,
            'scope' => config('azure.scopes', 'openid profile email'),
            'state' => $state,
            'prompt' => 'login',
        ]);

        $authorizeUrl = sprintf(config('azure.authorize_url'), $tenantId) . '?' . $params;

        return redirect()->away($authorizeUrl);
    }

    /**
     * Callback de Azure: intercambia code por tokens, obtiene email y resuelve portales.
     */
    public function callback(Request $request): RedirectResponse
    {
        $error = $request->query('error');
        $errorDescription = $request->query('error_description');
        if ($error) {
            return redirect()->route('login')->withErrors(['error' => $errorDescription ?: $error]);
        }

        $state = $request->query('state');
        $savedState = session('azure_state');
        if (! $state || $state !== $savedState) {
            return redirect()->route('login')->withErrors(['error' => 'Estado inválido. Intenta iniciar sesión de nuevo.']);
        }
        session()->forget('azure_state');

        $code = $request->query('code');
        if (! $code) {
            return redirect()->route('login')->withErrors(['error' => 'No se recibió código de autorización.']);
        }

        $tenantId = config('azure.tenant_id');
        $clientId = config('azure.client_id');
        $clientSecret = config('azure.client_secret');
        $redirectUri = config('azure.redirect_uri');

        if (! $tenantId || ! $clientId || ! $clientSecret) {
            return redirect()->route('login')->withErrors(['error' => 'Faltan variables de entorno de Azure.']);
        }

        $tokenUrl = sprintf(config('azure.token_url'), $tenantId);
        $postData = http_build_query([
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $redirectUri,
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
        ]);
        $context = stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => "Content-Type: application/x-www-form-urlencoded\r\nContent-Length: " . strlen($postData) . "\r\n",
                'content' => $postData,
                'ignore_errors' => true,
            ],
        ]);
        $responseBody = @file_get_contents($tokenUrl, false, $context);
        $responseCode = 200;
        if (isset($http_response_header[0]) && preg_match('/HTTP\/\d\.\d\s+(\d+)/', $http_response_header[0], $m)) {
            $responseCode = (int) $m[1];
        }
        if ($responseCode !== 200 || $responseBody === false) {
            $azureError = $this->parseAzureTokenError($responseBody);
            Log::warning('Azure token error', [
                'http_code' => $responseCode,
                'redirect_uri_sent' => $redirectUri,
                'azure_error' => $azureError,
                'response_body' => $responseBody !== false ? $responseBody : null,
            ]);
            $message = 'Error al obtener tokens de Azure. Revisa la configuración (redirect_uri en Azure).';
            if (config('app.debug') && ! empty($azureError)) {
                $message .= ' Detalle Azure: ' . $azureError;
            } else {
                $message .= ' Revisa storage/logs/laravel.log para el detalle.';
            }
            return redirect()->route('login')->withErrors(['error' => $message]);
        }
        $tokens = json_decode($responseBody, true);
        $idToken = $tokens['id_token'] ?? null;
        if (! $idToken) {
            return redirect()->route('login')->withErrors(['error' => 'Azure no devolvió id_token.']);
        }

        // Debug: claves de la respuesta de Azure (sin valores sensibles)
        session([
            'debug_token_keys' => array_keys($tokens ?? []),
            'debug_token_response_code' => $responseCode,
        ]);

        $claims = $this->decodeJwtPayload($idToken);
        if (! $claims) {
            return redirect()->route('login')->withErrors(['error' => 'Token inválido.']);
        }

        // Debug: claims del id_token (lo que "retorna" Azure/Graph)
        session(['debug_azure_claims' => $claims]);

        $email = $claims['preferred_username'] ?? $claims['email'] ?? '';
        $name = $claims['name'] ?? $claims['preferred_username'] ?? 'Usuario';

        if (empty($email)) {
            return redirect()->route('login')->withErrors(['error' => 'No se pudo obtener el correo del usuario.']);
        }

        $portalesPermitidos = $this->portalResolver->portalesPermitidosPorEmail($email);

        // Debug: resultado de consulta a las 3 bases de datos
        session([
            'debug_portales_result' => [
                'email_buscado' => $email,
                'portales_encontrados' => $portalesPermitidos,
                'cantidad' => count($portalesPermitidos),
            ],
        ]);

        if (empty($portalesPermitidos)) {
            return redirect()->route('login')->withErrors(['error' => 'No tiene acceso a ningún portal. Contacte al administrador.']);
        }

        session([
            'azure_email' => $email,
            'azure_name' => $name,
            'portales_permitidos' => $portalesPermitidos,
        ]);

        return redirect()->route('portal.hub');
    }

    /**
     * Extrae mensaje legible del error que devuelve Azure al fallar el canje de tokens.
     */
    private function parseAzureTokenError($responseBody): string
    {
        if ($responseBody === false || $responseBody === '') {
            return '';
        }
        $data = json_decode($responseBody, true);
        if (! is_array($data)) {
            return strlen($responseBody) > 200 ? substr($responseBody, 0, 200) . '…' : $responseBody;
        }
        $parts = [];
        if (! empty($data['error'])) {
            $parts[] = $data['error'];
        }
        if (! empty($data['error_description'])) {
            $parts[] = $data['error_description'];
        }
        return implode(' — ', $parts);
    }

    /**
     * Decodifica el payload (parte central) de un JWT en base64url.
     */
    private function decodeJwtPayload(string $token): ?array
    {
        $parts = explode('.', $token);
        if (count($parts) !== 3) {
            return null;
        }
        $payload = $parts[1];
        $payload = str_replace(['-', '_'], ['+', '/'], $payload);
        $decoded = base64_decode($payload, true);
        if ($decoded === false) {
            return null;
        }
        $json = json_decode($decoded, true);
        return is_array($json) ? $json : null;
    }
}
