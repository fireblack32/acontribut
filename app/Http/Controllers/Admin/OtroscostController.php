<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OtrosCostos;
use App\Imports\OtrosCostosImport;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class OtroscostController extends Controller
{
    /**
     * Mostrar la vista principal del módulo de Otros Costos
     * y listar los costos del mes seleccionado.
     */
    public function index(Request $request)
    {
        $mes = $request->input('mes'); // formato esperado: YYYY-MM

        if ($mes) {
            // Filtramos por el período real (columna Fecha)
            $data = OtrosCostos::whereRaw('DATE_FORMAT(Fecha, "%Y-%m") = ?', [$mes])
                ->orderBy('Fecha', 'desc')
                ->get();
        } else {
            // Si no se ha seleccionado mes, devolvemos colección vacía
            $data = collect();
        }

        return view('otroscost.index', compact('data'));
    }

    /**
     * Importar archivo de Excel / CSV y guardar registros en otros_costos.
     */
    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt,xlsx,xls',
        ]);

        try {
            Excel::import(new OtrosCostosImport(auth()->id()), $request->file('file'));

            return back()->with('success', 'Datos importados correctamente.');
        } catch (\Throwable $e) {
            Log::error('Error importando otros costos: '.$e->getMessage());

            return back()->with('error', 'Ocurrió un error al importar el archivo.');
        }
    }

    /**
     * Eliminar todos los registros de un mes específico.
     */
    public function deleteMonth(Request $request)
    {
        $request->validate([
            'mes' => 'required|date_format:Y-m',   // ej: 2025-10
        ]);

        try {
            $mes = $request->input('mes');        // "2025-10"

            // Borramos por el período real (columna Fecha)
            $deleted = OtrosCostos::whereRaw('DATE_FORMAT(Fecha, "%Y-%m") = ?', [$mes])
                ->delete();

            if ($deleted > 0) {
                return back()->with('success', "Se eliminaron {$deleted} registros del mes seleccionado.");
            } else {
                return back()->with('success', 'No había registros para el mes seleccionado.');
            }

        } catch (\Throwable $e) {
            Log::error('Error eliminando mes en otros_costos: '.$e->getMessage());

            return back()->with('error', 'Ocurrió un error al eliminar el mes.');
        }
    }

    public function editar($id)
    {
        //dd($id);
         $registro = OtrosCostos::findOrFail($id);
         return view('otroscost.editar', compact('registro'));
        
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'tarifa' => 'required|numeric',
        'capacidad' => 'required|integer',
        'idtipo_auditoria' => 'required|integer',
        'Fecha' => 'required|date',
    ]);

    $registro = OtrosCostos::findOrFail($id);

    $registro->tarifa = $request->tarifa;
    $registro->capacidad = $request->capacidad;
    $registro->idtipo_auditoria = $request->idtipo_auditoria;
    $registro->Fecha = $request->Fecha;
    $registro->fecha_mod = now();
    $registro->save();

    return redirect()->route('otroscost.index', ['mes' => substr($request->Fecha, 0, 7)])
        ->with('success', 'Registro actualizado correctamente.');
}


    /**
     * Copiar todos los registros de un mes origen a un mes destino.
     */
    public function copyMonth(Request $request)
    {
        $request->validate([
            'from' => 'required|date_format:Y-m',
            'to'   => 'required|date_format:Y-m',
        ]);

        try {
            $from = $request->input('from');  // ej. 2025-10
            $to   = $request->input('to');    // ej. 2025-11

            // Traemos registros del mes origen según el período (Fecha)
            $originals = OtrosCostos::whereRaw('DATE_FORMAT(Fecha, "%Y-%m") = ?', [$from])
                ->get();

            if ($originals->isEmpty()) {
                return back()->with('error', 'No existen registros en el mes de origen seleccionado.');
            }

            foreach ($originals as $item) {
                OtrosCostos::create([
                    'idcliente'        => $item->idcliente,
                    'tarifa'           => $item->tarifa,
                    'idtipo_auditoria' => $item->idtipo_auditoria,
                    'idusuario'        => $item->idusuario,
                    'capacidad'        => $item->capacidad,
                    // Nuevo período para el costo
                    'Fecha'            => $to . '-01',
                    // Fecha de modificación
                    'fecha_mod'        => now(),
                ]);
            }

            return back()->with('success', 'Mes copiado exitosamente.');
        } catch (\Throwable $e) {
            Log::error('Error copiando mes en otros_costos: '.$e->getMessage());

            return back()->with('error', 'Ocurrió un error al trasladar el mes.');
        }
    }
}
