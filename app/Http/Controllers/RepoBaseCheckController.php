<?php

namespace App\Http\Controllers;

use App\Models\Admin\Client;
use App\Models\Admin\obligaciones;
use App\Models\Admin\User;
use Illuminate\Http\Request;

class RepoBaseCheckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        can('listar-basechek');
        $cliente = Client::orderBy('nombre', 'ASC')->pluck('id','nombre');
        $obligaciones=obligaciones ::orderBy('nombre', 'ASC')->pluck('idobligaciones','nombre');
        $usuarios=User::orderBy('nombre', 'ASC')->pluck('id','nombre');
        return view('repobasecheck.index', compact('cliente','obligaciones','usuarios'));
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
        can('listar-basechek');
        $cliente = $request->input("cliente");
        $activo = $request->input("activo");
        $Fechaini = $request->input("Fechaini");
        $Fechafin = $request->input("Fechafin");
        $obligacion = $request->input("obligacion");
        $estadoobl1 = $request->input("estadoobl1");
        $estadoobl2 = $request->input("estadoobl2");
        $estadoobl3 = $request->input("estadoobl3");
        $estadoobl4 = $request->input("estadoobl4");
        $estadoobl5 = $request->input("estadoobl5");
        $estadoobl6 = $request->input("estadoobl6");
        $estadoobl7 = $request->input("estadoobl7");
        $usuario = $request->input("usuario");
        return view('repobasecheck.index2', compact('cliente','activo','Fechaini','Fechafin','obligacion','estadoobl1','estadoobl2','estadoobl3','estadoobl4','estadoobl5','estadoobl6','estadoobl7','usuario'));


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
        can('listar-basechek');
        //dd($request);
        $cliente = $request->input("cliente");
        $activo = $request->input("activo");
        $Fechaini = $request->input("Fechaini");
        $Fechafin = $request->input("Fechafin");
        $obligacion = $request->input("obligacion");
        $estadoobl1 = $request->input("estadoobl1");
        $estadoobl2 = $request->input("estadoobl2");
        $estadoobl3 = $request->input("estadoobl3");
        $estadoobl4 = $request->input("estadoobl4");
        $estadoobl5 = $request->input("estadoobl5");
        $estadoobl6 = $request->input("estadoobl6");
        $estadoobl7 = $request->input("estadoobl7");
        $usuario = $request->input("usuario");
        return view('repobasecheck.index3', compact('cliente','activo','Fechaini','Fechafin','obligacion','estadoobl1','estadoobl2','estadoobl3','estadoobl4','estadoobl5','estadoobl6','estadoobl7','usuario'));
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
