<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Client;
use App\Models\Admin\obligaciones;
use App\Models\Admin\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class AsignaObligController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cliente = Client::orderBy('nombre', 'ASC')->pluck('id','nombre');
        
        return view('admin.asignaroblig.index', compact('cliente'));
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
        $cliente = $request->input("cliente");
        return view('admin.asignaroblig.index2', compact('cliente'));
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
    public function guardar(Request $request)
    {
        //
        $usuarioweb=session()->get('usuario');
        $id=DB::select('select id from usuario_web where usuario = ?', [$usuarioweb]);
        $usuarioweb=implode('', array_column($id, 'id'));
        $current = Carbon::now();
        $current = new Carbon();
        //dd($request);
        $idob='';
        $id=DB::select('SELECT COUNT(`idobligaciones`)as id FROM `obligaciones`');
        $num=implode('', array_column($id, 'id'));
        //dd($num);
        for ($i=1;$i<=$num;$i++){
            $idcambio="idcambio".$idob;
            $obligacionenv="ob".$i;	
            $usuariorensen="usuarioren".$i;
            //echo $idcambio." ".$obligacionenv." ".$usuariorensen."<br>";
            $obligaciones = $request->input($obligacionenv);
            $usuarioren = $request->input($usuariorensen);
            $documento = $request->input("cliente");
            //echo $obligaciones."-".$usuarioren."<br>";
            if($obligaciones!=""){
                $update2="update".$i;
                $update = $request->input($update2);
                if($update==0){	
                    DB::insert('insert into `cliente_has_obligaciones`(`cliente_idcliente`,`obligaciones_idobligaciones`, `idusuario_web`, `fecha_rev`, `idusuario_web_encargado`) values (?, ?, ?, ?, ?)', [$documento, $obligaciones,$usuarioweb,now(),$usuarioren]);	
                }else{
                    $query="UPDATE `cliente_has_obligaciones` SET `idusuario_web`='$usuarioweb', `fecha_rev`=Now(), 
                    `idusuario_web_encargado`='$usuarioren' WHERE `obligaciones_idobligaciones`='$i' and `cliente_idcliente`='$documento'";
                    $database =Config::get('database.connections.'.Config::get('database.default'));
                    $database_name=$database['database'];
                    $database_host = $database['host'];
                    $database_password =  $database['password'];
                    $database_user =  $database['username'];
                    $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                    $resultooblig=mysqli_query($conn,$query);
                    
                    //echo $query."<br>";	
                    //
                    $querytab="SELECT `tabla_obligacion` FROM `obligaciones` WHERE `idobligaciones`='$i'";
                    $database =Config::get('database.connections.'.Config::get('database.default'));
                    $database_name=$database['database'];
                    $database_host = $database['host'];
                    $database_password =  $database['password'];
                    $database_user =  $database['username'];
                    $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                    $resultooblig=mysqli_query($conn,$querytab);
                            
                    while($row=mysqli_fetch_array($resultooblig)){
                      $tabla_obligacion=$row["tabla_obligacion"];
                    }
                    
                    
                    $queryact="UPDATE $tabla_obligacion set `idusuario_web`='$usuarioren' where cliente_idcliente='".$documento."' and `Estado`<>'7'";
                    $database =Config::get('database.connections.'.Config::get('database.default'));
                    $database_name=$database['database'];
                    $database_host = $database['host'];
                    $database_password =  $database['password'];
                    $database_user =  $database['username'];
                    $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                    $resultoact=mysqli_query($conn,$queryact);
                    
                    
		   // echo $queryact."<br>";
		  //  dd ($queryact);
                }


            }

        }
        $cliente=$documento;
        return view('admin.asignaroblig.index2', compact('cliente'));
        
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
