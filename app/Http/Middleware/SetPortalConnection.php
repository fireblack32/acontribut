<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class SetPortalConnection
{
    /**
     * Establece la conexión de BD por defecto según el portal seleccionado.
     * Si el usuario está autenticado pero no tiene portal_actual (ej. entró por Azure y no ha elegido portal), redirige al hub.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $portal = session('portal_actual');

        // Si está autenticado por Laravel Auth pero no tiene portal (flujo Azure: ya pasó por hub pero no ha elegido)
        if (auth()->check() && empty($portal)) {
            // Si tiene portales_permitidos es flujo Azure sin haber elegido portal aún
            if (session()->has('portales_permitidos')) {
                return redirect()->route('portal.hub');
            }
            // Login legacy: usar conexión por defecto (mysql)
            return $next($request);
        }

        if (! empty($portal)) {
            Config::set('database.default', $portal);
        }

        return $next($request);
    }
}
