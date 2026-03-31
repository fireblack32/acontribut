<?php

namespace App\Http\Middleware;

use Closure;

class PermisoAdministrador
{
    /**
     * Maneja una solicitud entrante.
     */
    public function handle($request, Closure $next)
    {
        // Aquí validamos si el rol_id del usuario actual está en la lista permitida
        if (!$this->permiso()) {
           // dd(session()->get('rol_id'));
            // Si no tiene permiso, lo regresamos con un mensaje
            return redirect('/')->with('mensaje', 'No tiene permisos para ingresar a esta opción');
        }

        // Si tiene permiso, continúa con la solicitud
        return $next($request);
    }

    /**
     * Verifica si el usuario tiene un rol permitido (1=Administrador, 3=Líder)
     */
    private function permiso()
    {
        //dd(session()->get('rol_id'));
        return in_array(session()->get('rol_id'), ['1', '2','3']);
    }
}
