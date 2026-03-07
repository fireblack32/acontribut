<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CostoUsuario;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CostoUsuarioImport;
use Illuminate\Support\Facades\Log;

class CostUsuarClienteController extends Controller
{
    /**
     * Mostrar la vista principal del módulo de Costos de Usuarios
     * y, si viene un mes, listar los costos cargados de ese mes.
     */
    public function index(Request $request)
{
    $mes = $request->input('mes'); // formato esperado: YYYY-MM

    if ($mes) {
        // Eager loading de la relación usuario y filtramos por el período (Fecha)
        $data = CostoUsuario::with(['usuario' => function ($q) {
                // Solo los campos que necesitas de usuario_web
                $q->select('id', 'documento', 'nombre', 'apellidos');
            }])
            ->whereRaw('DATE_FORMAT(Fecha, "%Y-%m") = ?', [$mes])
            ->get();
    } else {
        $data = collect();
    }

    return view('costousu.index', compact('data'));
}

    /**
     * Importar archivo de Excel y guardar registros en costo_usuario.
     */
    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt,xlsx,xls',
        ]);

        try {
            Excel::import(new CostoUsuarioImport(auth()->id()), $request->file('file'));

            return back()->with('success', 'Datos importados correctamente.');
        } catch (\Throwable $e) {
            Log::error('Error importando costos de usuario: '.$e->getMessage());

            return back()->with('error', 'Ocurrió un error al importar el archivo.');
        }
    }

    /**
     * Eliminar todos los registros de un mes específico.
     */
    public function deleteMonth(Request $request)
    {
        $request->validate([
            'mes' => 'required|date_format:Y-m',   // ej: 2025-11
        ]);

        try {
            $mes = $request->input('mes');        // "2025-11"

            // Borramos por el período real (columna Fecha)
            $deleted = CostoUsuario::whereRaw('DATE_FORMAT(Fecha, "%Y-%m") = ?', [$mes])
                ->delete();

            if ($deleted > 0) {
                return back()->with('success', "Se eliminaron {$deleted} registros del mes seleccionado.");
            } else {
                return back()->with('success', 'No había registros para el mes seleccionado.');
            }

        } catch (\Throwable $e) {
            Log::error('Error eliminando mes en costo_usuario: '.$e->getMessage());

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
            $from = $request->input('from');  // ej. 2025-11
            $to   = $request->input('to');    // ej. 2025-12

            // Traemos registros del mes origen según el período (Fecha)
            $originals = CostoUsuario::whereRaw('DATE_FORMAT(Fecha, "%Y-%m") = ?', [$from])
                ->get();

            if ($originals->isEmpty()) {
                return back()->with('error', 'No existen registros en el mes de origen seleccionado.');
            }

            foreach ($originals as $item) {
                CostoUsuario::create([
                    'idusuario' => $item->idusuario,
                    'costo'     => $item->costo,
                    'perfil'    => $item->perfil,
                    'capacidad' => $item->capacidad,
                    // Nuevo período de costo
                    'Fecha'     => $to . '-01',
                    // Fecha de modificación/carga
                    'fecha_mod' => now(),
                ]);
            }

            return back()->with('success', 'Mes copiado exitosamente.');
        } catch (\Throwable $e) {
            Log::error('Error copiando mes en costo_usuario: '.$e->getMessage());

            return back()->with('error', 'Ocurrió un error al trasladar el mes.');
        }
    }
     public function editar($id)
    {
        //dd($id);
         $registro = CostoUsuario::findOrFail($id);
         
         return view('costousu.editar', compact('registro'));
        
    }

     public function update(Request $request, $id)
{
    //dd($request,$id);
    $request->validate([
        'costo'     => 'required|numeric',
        'capacidad' => 'required|integer',
        'perfil'    => 'nullable|string',
        'Fecha'     => 'required|date',
    ]);

    $registro = CostoUsuario::findOrFail($id);

    $registro->costo     = $request->costo;
    $registro->capacidad = $request->capacidad;
    $registro->perfil    = $request->perfil;
    $registro->Fecha     = $request->Fecha;
    $registro->fecha_mod = now();
    $registro->save();

    return redirect()->route('costusuar.index', ['mes' => substr($request->Fecha, 0, 7)])
        ->with('success', 'Registro actualizado correctamente.');
}


}
