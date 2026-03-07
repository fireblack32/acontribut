<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ElimiObliClienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clientes=Client::orderBy('nombre', 'ASC')->pluck('id','nombre');
       
        return view('admin.elimobligcliente.index', compact('clientes'));
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
        //dd($request);
        $cliente = $request->input("cliente");
        return view('admin.elimobligcliente.index2', compact('cliente'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index3($id,$vardos)
    {
        //
        $tabla_obligacion='';
        $database =Config::get('database.connections.'.Config::get('database.default'));
        $database_name=$database['database'];
        $database_host = $database['host'];
        $database_password =  $database['password'];
        $database_user =  $database['username'];
        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);

        $querybus="SELECT `cliente_idcliente`,`obligaciones_idobligaciones` FROM `cliente_has_obligaciones` WHERE `id`='$id'";
        $resultbusq=mysqli_query($conn,$querybus);
        while ($row = mysqli_fetch_array($resultbusq)){
            $cliente_idcliente=$row["cliente_idcliente"];
            $idobligaciones=$row["obligaciones_idobligaciones"];   
        }

        $querytabla="SELECT `tabla_obligacion` FROM `obligaciones` WHERE `idobligaciones`='$idobligaciones'";
        $resultbusq=mysqli_query($conn,$querytabla);
        while ($row = mysqli_fetch_array($resultbusq)){
            $tabla_obligacion=$row["tabla_obligacion"];   
        }

        $querydeltabla="Delete from $tabla_obligacion WHERE `cliente_idcliente`='$cliente_idcliente' and `Estado`<>'7'";
        echo $querydeltabla;
        $resultpasostbla=mysqli_query($conn,$querydeltabla);

        $querydel="Delete from `cliente_has_obligaciones` WHERE `id`='$id'";
        echo "<br>".$querydel;
        $resultpasos=mysqli_query($conn,$querydel);

        return redirect('admin/elimobcliente')->with('mensaje', 'Obligación eliminada con exito');

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
