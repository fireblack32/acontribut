<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class PortalResolver
{
    protected static $portales = ['contabilidad', 'auditoria', 'legales'];

    /**
     * Devuelve los nombres de portales en los que el usuario existe y está activo (estado=1).
     *
     * @param string $email
     * @return array<string>
     */
    public function portalesPermitidosPorEmail(string $email): array
    {
        $permitidos = [];

        foreach (self::$portales as $portal) {
            try {
                $exists = DB::connection($portal)
                    ->table('usuario_web')
                    ->where('email', $email)
                    ->where('estado', 1)
                    ->exists();

                if ($exists) {
                    $permitidos[] = $portal;
                }
            } catch (\Throwable $e) {
                // Conexión no disponible o tabla no existe; omitir este portal
                continue;
            }
        }

        return $permitidos;
    }
}
