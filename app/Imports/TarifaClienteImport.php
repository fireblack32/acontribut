<?php

namespace App\Imports;

use App\Models\TarifaCliente;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use Carbon\Carbon;
use Throwable;

class TarifaClienteImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        try {
            $nit   = is_numeric($row['nit'] ?? null) ? (int) $row['nit'] : 0;
            $costo = is_numeric($row['costo'] ?? null) ? (float) $row['costo'] : 0;
            $horas = is_numeric($row['horas_pactadas'] ?? null) ? (int) $row['horas_pactadas'] : 0;

            // -------------------------------------------------
            // 📅 Manejo de fecha_original (texto o número Excel)
            // -------------------------------------------------
            $valorFecha = $row['fecha_original'] ?? null;
            $fecha = null;

            if ($valorFecha === null || $valorFecha === '') {
                // Si no viene fecha, usamos ahora (o podrías poner null)
                $fecha = now();
            } else {
                if (is_numeric($valorFecha)) {
                    // Caso xlsx/xls: Excel serial date (ej. 45678)
                    $fecha = Carbon::instance(
                        ExcelDate::excelToDateTimeObject($valorFecha)
                    )->startOfDay();
                } else {
                    // Caso CSV / texto: "1/11/2025" (d/m/Y)
                    $fechaOriginal = trim($valorFecha);

                    // Ajusta el formato si en tu archivo es distinto
                    $fecha = Carbon::createFromFormat('d/m/Y', $fechaOriginal)
                                   ->startOfDay();
                }
            }

            return new TarifaCliente([
                'cliente'        => $nit,
                'VP_Junior'      => $costo,
                'VP_Senior'      => 0,
                'VP_Director'    => 0,
                'VP_Socio'       => 0,
                'Horas_Pactadas' => $horas,
                'Total_Pactado'  => $costo,
                'fecha_mod'      => $fecha ? $fecha->format('Y-m-d H:i:s') : null,
                'fecha_carga'    => now(),
            ]);

        } catch (Throwable $e) {
            Log::error('Error importando tarifas: '.$e->getMessage(), $row);
            return null;
        }
    }
}
