<?php

namespace App\Http\Controllers;

use App\Models\Seguridad\Usuario;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PortalController extends Controller
{
    /**
     * URLs externas de cada portal. Si un portal no está aquí, se maneja localmente.
     */
    protected $portalUrls = [];

    public function __construct()
    {
        $this->portalUrls = [
            'contabilidad' => config('portales.urls.contabilidad', 'https://gestioncontabilidad.optimalsolutions.com.co/public'),
            'auditoria' => config('portales.urls.auditoria', 'https://gestionauditoria.acontributsa.com/public'),
            'legales' => config('portales.urls.legales', 'https://gestionlegales.optimalsolutions.com.co/public'),
        ];
    }

    /**
     * Muestra el hub de selección de portal (solo si hay portales_permitidos en sesión).
     */
    public function hub(Request $request)
    {
        $portales = session('portales_permitidos', []);
        if (empty($portales)) {
            return redirect()->route('login')->withErrors(['error' => 'Debe iniciar sesión con Microsoft primero.']);
        }

        return view('portal.hub', [
            'azure_name' => session('azure_name', 'Usuario'),
            'azure_email' => session('azure_email', ''),
            'portales_permitidos' => $portales,
        ]);
    }

    /**
     * Entra al portal seleccionado: si es externo redirige con token, si es local autentica.
     */
    public function entrar(Request $request, string $portal): RedirectResponse
    {
        $portalesPermitidos = session('portales_permitidos', []);
        if (! in_array($portal, $portalesPermitidos, true)) {
            return redirect()->route('portal.hub')->withErrors(['error' => 'No tiene acceso a ese portal.']);
        }

        // Portal externo: generar token y redirigir
        if (isset($this->portalUrls[$portal])) {
            return $this->redirigirPortalExterno($portal);
        }

        // Portal local
        return $this->autenticarLocal($portal);
    }

    /**
     * Genera un token temporal y redirige al portal externo.
     */
    protected function redirigirPortalExterno(string $portal): RedirectResponse
    {
        $token = Str::random(64);
        $email = session('azure_email');
        $name = session('azure_name', 'Usuario');

        // Guardar token en archivo compartido (expira en 5 min)
        $tokenData = json_encode([
            'email' => $email,
            'name' => $name,
            'portal' => $portal,
            'expires_at' => time() + 300,
        ]);

        $tokenPath = '/tmp/portal_token_' . hash('sha256', $token);
        file_put_contents($tokenPath, $tokenData);

        $url = rtrim($this->portalUrls[$portal], '/') . '/auth/token-login?token=' . $token;

        return redirect()->away($url);
    }

    /**
     * Recibe un token temporal y autentica al usuario localmente.
     */
    public function tokenLogin(Request $request): RedirectResponse
    {
        $token = $request->query('token');
        if (! $token) {
            return redirect()->route('login')->withErrors(['error' => 'Token no proporcionado.']);
        }

        $tokenPath = '/tmp/portal_token_' . hash('sha256', $token);
        if (! file_exists($tokenPath)) {
            return redirect()->route('login')->withErrors(['error' => 'Token inválido o expirado.']);
        }

        $tokenData = json_decode(file_get_contents($tokenPath), true);
        @unlink($tokenPath);

        if (! $tokenData || $tokenData['expires_at'] < time()) {
            return redirect()->route('login')->withErrors(['error' => 'Token expirado.']);
        }

        $email = $tokenData['email'];

        // Autenticar con la BD por defecto de esta instancia
        $user = Usuario::where('email', $email)
            ->where('estado', 1)
            ->first();

        if (! $user) {
            return redirect()->route('login')->withErrors(['error' => 'Usuario no encontrado.']);
        }

        $roles = $user->roles()->get();
        if ($roles->isEmpty()) {
            return redirect()->route('login')->withErrors(['error' => 'Este usuario no tiene un rol activo.']);
        }

        $user->setSession($roles->toArray());
        Auth::login($user);

        return redirect('/admin');
    }

    /**
     * Autentica al usuario localmente en el portal seleccionado.
     */
    protected function autenticarLocal(string $portal): RedirectResponse
    {
        session(['portal_actual' => $portal]);

        $user = Usuario::on($portal)
            ->where('email', session('azure_email'))
            ->where('estado', 1)
            ->first();

        if (! $user) {
            session()->forget('portal_actual');
            return redirect()->route('portal.hub')->withErrors(['error' => 'Usuario no encontrado en ese portal.']);
        }

        $roles = $user->roles()->get();
        if ($roles->isEmpty()) {
            session()->forget('portal_actual');
            return redirect()->route('portal.hub')->withErrors(['error' => 'Este usuario no tiene un rol activo en ese portal.']);
        }

        $user->setSession($roles->toArray());
        Auth::login($user);

        return redirect('/admin');
    }
}
