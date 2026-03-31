<?php

namespace App\Http\Controllers;

use App\Models\Admin\User;
use Illuminate\Http\Request;

class AuditChecklistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        can('listar-audit');
        $usuario = User::orderBy('usuario', 'ASC')->where('estado', '1')->pluck('id','usuario');
        
        return view('auditchecklist.index', compact('usuario'));
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
    public function index2(Request $request)
    {
        //
        //dd($request);
        $usuario = $request->input("usuario");
        return view('auditchecklist.index2', compact('usuario'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function fechas(Request $request)
    {
        //
        //dd($request);
        $usuario = $request->input("usuario");
        $fecha_ini = $request->input("fecha_ini");
        $fecha_fin = $request->input("fecha_fin");
        return view('auditchecklist.index4', compact('usuario','fecha_ini','fecha_fin'));


    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function todos($usuario)
    {
        //
        
        
       // dd($usuario);
        return view('auditchecklist.index3', compact('usuario'));
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
