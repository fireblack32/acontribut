<?php

namespace App\Imports;

use App\Models\CostoUsuario;
use App\Models\Admin\User;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use Carbon\Carbon;
use Throwable;

class CostoUsuarioImport implements ToModel, WithHeadingRow, WithCustomCsvSettings
{
    private $actorUserId;

    public function __construct($actorUserId)
    {
        $this->actorUserId = (int) $actorUserId;
    }

    /**
     * Configuración CSV (si el archivo es XLSX, esto no se usa).
     */
    public function getCsvSettings(): array
    {
        return [
            'delimiter'      => ';',
            'enclosure'      => '"',
            'input_encoding' => 'UTF-8',
        ];
    }

    /**
     * Procesa cada fila del archivo importado.
     */
    public function model(array $row)
    {
        try {
            Log::info("📥 Procesando fila Costos Usuarios", $row);

            /* -------------------------------------------------------
             * 1️⃣ Normalizar cédula: quitar puntos, espacios, guiones
             * -----------------------------------------------------*/
            $cedulaRaw  = trim((string)($row['cedula'] ?? ''));
            $cedulaNorm = preg_replace('/\D+/', '', $cedulaRaw); // sólo dígitos

            if (!$cedulaNorm) {
                Log::warning("⚠️ Cédula inválida, fila ignorada", [
                    'cedula_raw'  => $cedulaRaw,
                    'cedula_norm' => $cedulaNorm,
                ]);
                return null; // no intentamos nada más
            }

            /* -------------------------------------------------------
             * 2️⃣ Buscar usuario exacto → luego normalizado por SQL
             * -----------------------------------------------------*/
            $usuario = User::where('documento', $cedulaNorm)->first();

            if (!$usuario) {
                $usuario = User::whereRaw("
                    REPLACE(REPLACE(REPLACE(documento, '.', ''), ' ', ''), '-', '') = ?
                ", [$cedulaNorm])->first();
            }

            if (!$usuario) {
                Log::warning("❌ Usuario NO encontrado, fila ignorada", [
                    'cedula_raw'  => $cedulaRaw,
                    'cedula_norm' => $cedulaNorm,
                ]);
                return null; // 👈 Opción A: NO insertamos nada si no hay usuario
            }

            Log::info("🧑‍💼 Usuario encontrado", [
                'id'        => $usuario->id,
                'documento' => $usuario->documento,
                'cedula_norm' => $cedulaNorm,
            ]);

            /* -------------------------------------------------------
             * 3️⃣ Normalizar Costo (ej: "3.154.609,00" → 3154609.00)
             *  - Si viene "-" o vacío, lo tratamos como 0
             * -----------------------------------------------------*/
            $costoRaw = trim((string)($row['costo'] ?? '0'));

            if ($costoRaw === '' || $costoRaw === '-') {
                $costoNum = 0.0;
            } else {
                // quitamos separadores de miles y dejamos el decimal
                $costoNum = (float) str_replace(',', '.', str_replace('.', '', $costoRaw));
            }

            /* -------------------------------------------------------
             * 4️⃣ Capacidad
             * -----------------------------------------------------*/
            $capacidad = is_numeric($row['capacidad'] ?? null)
                ? (int) $row['capacidad']
                : 0;

            /* -------------------------------------------------------
             * 5️⃣ Perfil (si no viene, se toma del usuario)
             * -----------------------------------------------------*/
            $perfil = is_numeric($row['perfil'] ?? null)
                ? (int) $row['perfil']
                : (int) ($usuario->perfil_idperfil ?? 1);

            /* -------------------------------------------------------
             * 6️⃣ Fecha → periodo de costo (columna "fecha")
             *      - Acepta serial Excel o texto dd/mm/yyyy
             * -----------------------------------------------------*/
            $fechaRaw = trim((string)($row['fecha'] ?? ''));

            if ($fechaRaw === '') {
                $fecha = now()->startOfMonth();
            } else {
                if (is_numeric($fechaRaw)) {
                    // serial Excel
                    $fecha = Carbon::instance(ExcelDate::excelToDateTimeObject($fechaRaw))
                                   ->startOfDay();
                } else {
                    try {
                        // dd/mm/yyyy
                        $fecha = Carbon::createFromFormat('d/m/Y', $fechaRaw)->startOfDay();
                    } catch (Throwable $e) {
                        Log::warning("⚠️ Fecha inválida, usando fecha actual", [
                            'fecha_raw' => $fechaRaw,
                        ]);
                        $fecha = now()->startOfMonth();
                    }
                }
            }

            /* -------------------------------------------------------
             * 7️⃣ Crear registro en costo_usuario
             * -----------------------------------------------------*/
            $payload = [
                'idusuario' => (int) $usuario->id,
                'costo'     => $costoNum,
                'perfil'    => $perfil,
                'capacidad' => $capacidad,
                'Fecha'     => $fecha->format('Y-m-d'),
                'fecha_mod' => now(),
            ];

            Log::info("🧩 Insertando costo_usuario", $payload);

            $created = CostoUsuario::create($payload);

            Log::info("✅ Registro insertado en costo_usuario", [
                'id'        => $created->id,
                'idusuario' => $created->idusuario,
            ]);

            // devolvemos null porque no usamos el modelo que retorna
            return null;

        } catch (Throwable $e) {
            Log::error("💥 Excepción general en CostoUsuarioImport: ".$e->getMessage(), [
                'fila'  => $row,
                'trace' => $e->getTraceAsString(),
            ]);

            return null;
        }
    }
}
