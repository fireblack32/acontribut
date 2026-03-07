<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidacionActmanager;
use App\Models\admin\GrupoTimeManager;
use App\Models\admin\TipoTimeManager;
use Illuminate\Http\Request;

class ActtimemanagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas = TipoTimeManager::orderBy('id')->get();
        return view('admin.acttimemanager.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        //
        $grupotm=GrupoTimeManager::pluck('IdGrupo','Descripcion');
        //dd($data);
        return view('admin.acttimemanager.crear',compact('data','grupotm') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(ValidacionActmanager $request)
    {
        //
        TipoTimeManager::create($request->all());
        return redirect('admin/acttimemanager')->with('mensaje', 'Actividad creada con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        //dd($data);
        $grupotm=GrupoTimeManager::pluck('IdGrupo','Descripcion');
        $data = TipoTimeManager::findOrFail($id);
        return view('admin.acttimemanager.editar',compact('data','grupotm') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(ValidacionActmanager $request, $id)
    {
        //
        TipoTimeManager::findOrFail($id)->update($request->all());
        return redirect('admin/acttimemanager')->with('mensaje', 'Actividad actualizada con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar(Request $request, $id)
    {
        //
        if ($request->ajax()){
            // @dd($id);
             if (TipoTimeManager::destroy($id)) {
                 return response()->json(['mensaje' => 'ok']);
             } else {
                 return response()->json(['mensaje' => 'ng']);
             }
         } else {
             abort(404);
             
         }
    }
}
