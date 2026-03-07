<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PgAdministrableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index1($id,$cliente)
    {
        //
        return view('admin.pgperioadmin.administrable', compact('id','cliente'));
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
    public function guardar(Request $request)
    {
        //

        $fecha = $request->input("fecha");
        $diasencargado = $request->input("diasencargado");
        $diascliente = $request->input("diascliente");
        $encargado = $request->input("encargado");
        $idobligacion = $request->input("idobligacion");
        $cliente = $request->input("cliente");
        $descripcion = $request->input("descripcion");
        $now=Now();
        if ($idobligacion=='15'){
            // dd($request);
             $certificado= $request->input("certificado");
         
           //echo $fecha."<br>";
           DB::insert('insert into ob_administrable (fecha, Dias_H_Cliente,Dias_H_Encargado,descripcion,cliente_idcliente,idusuario_web, fecha_rev,Estado) values (?, ?, ?, ?, ?,?,?,?)', [$fecha,$diascliente,$diasencargado, $descripcion,$cliente, $encargado, $now,'0']);
           
           
           return redirect('admin/pgperioadmin')->with('mensaje', 'Registro creado con exito');
 
         }
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
