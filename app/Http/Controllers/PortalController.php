<?php

namespace App\Http\Controllers;

use App\Models\Seguridad\Usuario;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortalController extends Controller
{
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
     * Entra al portal seleccionado: establece sesión de aplicación y redirige a /admin.
     */
    public function entrar(Request $request, string $portal): RedirectResponse
    {
        $portalesPermitidos = session('portales_permitidos', []);
        if (! in_array($portal, $portalesPermitidos, true)) {
            return redirect()->route('portal.hub')->withErrors(['error' => 'No tiene acceso a ese portal.']);
        }

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

        // Debug: usuario y roles cargados de la BD del portal
        session([
            'debug_entrar_portal' => [
                'portal' => $portal,
                'usuario_bd' => [
                    'id' => $user->id,
                    'usuario' => $user->usuario,
                    'nombre' => $user->nombre,
                    'email' => $user->email,
                ],
                'roles' => $roles->map(function ($r) {
                    return ['id' => $r->id, 'nombre' => $r->nombre];
                })->toArray(),
            ],
        ]);

        $user->setSession($roles->toArray());
        Auth::login($user);

        return redirect('/admin');
    }
}
