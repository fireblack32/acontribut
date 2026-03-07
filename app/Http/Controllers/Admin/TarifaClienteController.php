<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TarifaCliente;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TarifaClienteImport;
use Illuminate\Support\Facades\Log;

class TarifaClienteController extends Controller
{
    /**
     * Mostrar la vista principal del módulo de rentabilidad
     * y, si viene un mes, listar las tarifas cargadas de ese mes.
     */
    public function index(Request $request)
    {
        $mes = $request->input('mes'); // formato esperado: YYYY-MM

        if ($mes) {
            $data = TarifaCliente::whereMonth('fecha_mod', date('m', strtotime($mes)))
                ->whereYear('fecha_mod', date('Y', strtotime($mes)))
                ->get();
        } else {
            // Si no se ha seleccionado mes, devolvemos colección vacía
            $data = collect();
        }

        return view('tarifa.index', compact('data'));
    }

    /**
     * Importar archivo de Excel y guardar registros en tarifa_cliente.
     */
    public function importExcel(Request $request)
    {
        // Acepta csv, txt, xlsx, xls
        $request->validate([
            'file' => 'required|file|mimes:csv,txt,xlsx,xls',
        ]);

        try {
            Excel::import(new TarifaClienteImport(), $request->file('file'));

            return back()->with('success', 'Datos importados correctamente.');
        } catch (\Throwable $e) {
            Log::error('Error importando tarifas: '.$e->getMessage());

            return back()->with('error', 'Ocurrió un error importando el archivo.');
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

            // Borramos por prefijo de texto, normalizando espacios
            $deleted = TarifaCliente::whereRaw('TRIM(fecha_mod) LIKE ?', [$mes.'%'])
                ->delete();

            if ($deleted > 0) {
                return back()->with('success', "Se eliminaron {$deleted} registros del mes seleccionado.");
            } else {
                return back()->with('success', 'No había registros para el mes seleccionado.');
            }
        } catch (\Throwable $e) {
            Log::error('Error eliminando mes en tarifa_cliente: '.$e->getMessage());

            return back()->with('error', 'Ocurrió un error al eliminar el mes.');
        }
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
            $from = $request->input('from');
            $to   = $request->input('to');

            // Traemos registros del mes origen
            $originals = TarifaCliente::whereMonth('fecha_mod', date('m', strtotime($from)))
                ->whereYear('fecha_mod', date('Y', strtotime($from)))
                ->get();

            if ($originals->isEmpty()) {
                return back()->with('error', 'No existen registros en el mes de origen seleccionado.');
            }

            foreach ($originals as $item) {
                TarifaCliente::create([
                    'cliente'        => $item->cliente,
                    'VP_Junior'      => $item->VP_Junior,
                    'VP_Senior'      => $item->VP_Senior,
                    'VP_Director'    => $item->VP_Director,
                    'VP_Socio'       => $item->VP_Socio,
                    'Horas_Pactadas' => $item->Horas_Pactadas,
                    'Total_Pactado'  => $item->Total_Pactado,
                    // Usamos el día 1 del mes destino
                    'fecha_mod'      => $to . '-01',
                    'fecha_carga'    => now(),
                ]);
            }

            return back()->with('success', 'Mes trasladado/copìado exitosamente.');
        } catch (\Throwable $e) {
            Log::error('Error copiando mes en tarifa_cliente: '.$e->getMessage());

            return back()->with('error', 'Ocurrió un error al trasladar el mes.');
        }
    }
     public function editar($id)
    {
        //dd($id);
         $registro = TarifaCliente::findOrFail($id);
         
         return view('tarifa.editar', compact('registro'));
        
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'VP_Junior'      => 'required|numeric|min:0',
        'VP_Senior'      => 'required|numeric|min:0',
        'VP_Director'    => 'required|numeric|min:0',
        'VP_Socio'       => 'required|numeric|min:0',
        'Horas_Pactadas' => 'required|integer|min:0',
        'costo'          => 'required|numeric|min:0',
        'Fecha'          => 'required|date',
    ]);

    try {
        $tarifa = TarifaCliente::findOrFail($id);

        $vpJunior   = (float) $request->VP_Junior;
        $vpSenior   = (float) $request->VP_Senior;
        $vpDirector = (float) $request->VP_Director;
        $vpSocio    = (float) $request->VP_Socio;
        $horas      = (int)   $request->Horas_Pactadas;
        $costo      = (float) $request->costo;

        // ✅ obligatorio
        $totalPactado = $costo;

        $tarifa->VP_Junior      = $vpJunior;
        $tarifa->VP_Senior      = $vpSenior;
        $tarifa->VP_Director    = $vpDirector;
        $tarifa->VP_Socio       = $vpSocio;
        $tarifa->Horas_Pactadas = $horas;
        $tarifa->Costo          = $costo;
        $tarifa->Total_Pactado  = $totalPactado;

        // ⚠️ Fecha del formulario → fecha_mod
        $tarifa->fecha_mod = $request->Fecha;

        $tarifa->save();

        return redirect()
            ->route('tarifa.index', ['mes' => substr($request->Fecha, 0, 7)])
            ->with('success', 'Tarifa actualizada correctamente.');

    } catch (\Throwable $e) {
        \Log::error('Error actualizando tarifa', [
            'id' => $id,
            'error' => $e->getMessage()
        ]);

        return back()->withInput()
            ->with('error', 'Ocurrió un error al actualizar la tarifa.');
    }
}
}
