<?php

namespace App\Imports;

use App\Models\OtrosCostos;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use Carbon\Carbon;
use Throwable;

class OtrosCostosImport implements ToModel, WithHeadingRow, WithCustomCsvSettings
{
    private $actorUserId;

    public function __construct($actorUserId)
    {
        $this->actorUserId = (int) $actorUserId;
    }

    /**
     * Configuración CSV (si el archivo es XLSX, esto se ignora).
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
            Log::info('📥 Fila otros_costos', $row);

            // 1️⃣ idcliente
            $idcliente = trim((string)($row['idcliente'] ?? ''));
            if ($idcliente === '') {
                Log::warning('Fila ignorada: idcliente vacío');
                return null;
            }

            // 2️⃣ tarifa (Costo) — ejemplo: "365.500" o "2.270.609,00"
            $costoRaw = trim((string)($row['costo'] ?? '0'));
            // Quitamos espacios
            $costoRaw = str_replace(' ', '', $costoRaw);
            // Primero quitamos puntos de miles, luego cambiamos coma por punto decimal
            $costoNum = (float) str_replace(',', '.', str_replace('.', '', $costoRaw));

            // 3️⃣ tipo de auditoría
            $idtipo = isset($row['idtipo_a']) && is_numeric($row['idtipo_a'])
                ? (int) $row['idtipo_a']
                : 0;

            // 4️⃣ capacidad
            $capacidad = isset($row['capacidad']) && is_numeric($row['capacidad'])
                ? (int) $row['capacidad']
                : 0;

            // 5️⃣ Fecha (periodo del costo)
            $fechaRaw = trim((string)($row['fecha_original'] ?? $row['fecha'] ?? ''));

            if ($fechaRaw === '') {
                $fecha = now()->startOfMonth();
            } else {
                if (is_numeric($fechaRaw)) {
                    // Serial Excel
                    $fecha = Carbon::instance(ExcelDate::excelToDateTimeObject($fechaRaw))
                        ->startOfDay();
                } else {
                    // Texto tipo "1/03/2025" (d/m/Y)
                    try {
                        $fecha = Carbon::createFromFormat('d/m/Y', $fechaRaw)->startOfDay();
                    } catch (Throwable $e) {
                        Log::warning('⚠️ Fecha inválida, usando fecha actual', ['fecha_raw' => $fechaRaw]);
                        $fecha = now()->startOfMonth();
                    }
                }
            }

            // 6️⃣ Construimos el payload para otros_costos
            $payload = [
                'idcliente'        => $idcliente,
                'tarifa'           => $costoNum,
                'idtipo_auditoria' => $idtipo,
                'idusuario'        => $this->actorUserId,
                'capacidad'        => $capacidad,
                'Fecha'            => $fecha->format('Y-m-d'),
                'fecha_mod'        => now(),
            ];

            Log::info('🧩 Insertando otros_costos', $payload);

            return new OtrosCostos($payload);

        } catch (Throwable $e) {
            Log::error('💥 Excepción en OtrosCostosImport: '.$e->getMessage(), [
                'fila'  => $row,
                'trace' => $e->getTraceAsString(),
            ]);
            return null;
        }
    }
}
