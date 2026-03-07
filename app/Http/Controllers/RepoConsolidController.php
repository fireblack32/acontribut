<?php

namespace App\Http\Controllers;
use App\Models\Admin\Client;
use App\Models\Admin\User;
use App\Models\ActividadesTimemanager;
use App\Models\GruposTimemanager;
use Illuminate\Http\Request;

class RepoConsolidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        can('listar-repoconsolid');
        $cliente = Client::orderBy('nombre', 'ASC')->pluck('id','nombre');
        $usuarios=User::orderBy('nombre', 'ASC')->pluck('id','nombre');
        $actividad=ActividadesTimemanager::orderBy('Descripcion', 'ASC')->pluck('id','Descripcion');
        $grupotimemanager=GruposTimemanager::orderBy('Descripcion', 'ASC')->pluck('IdGrupo','Descripcion');
        //return view('repobasecheck.index', compact('cliente','obligaciones','usuarios'));
        return view('repoconsolid.index',compact('cliente','usuarios','actividad','grupotimemanager'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function mostrar(Request $request)
    {
        //
        //dd($request);
        can('listar-repoconsolid');
        $Fechaini = $request->input("Fechaini");
        $Fechafin = $request->input("Fechafin");
        $cliente = $request->input("cliente");
        $usuario = $request->input("usuario");
        $actividad = $request->input("actividad");
        $grupo = $request->input("grupo");
        return view('repoconsolid.index2', compact('Fechaini','Fechafin','cliente','usuario','actividad','grupo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function excel(Request $request)
    {
        //
       //dd($request);
        can('listar-repoconsolid');
        $Fechaini = $request->input("Fechaini");
        $Fechafin = $request->input("Fechafin");
        $cliente = $request->input("cliente");
        $usuario = $request->input("usuario");
        $actividad = $request->input("actividad");
        $grupo = $request->input("grupo");
        return view('repoconsolid.index3', compact('Fechaini','Fechafin','cliente','usuario','actividad','grupo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
