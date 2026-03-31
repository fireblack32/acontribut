<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class ReagendarPerioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.reagendarperio.index');
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
        //dd($request);
        $usuarioweb=session()->get('usuario');
        $idusuario_web_encargado=$usuarioweb;
        $idusuarioweb=DB::select('select id from usuario_web where usuario = ?', [$usuarioweb]);
        $usuarioweb=implode('', array_column($idusuarioweb, 'id'));
        //$ano = Carbon::now('America/Bogota')->format('Y');
            
        $idob='';
        $resultado='';
        $ano = $request->input("datey");

        $query="SELECT `idobligaciones`, `nombre`, `tabla_obligacion` FROM `obligaciones` where `idobligaciones`>'26' and `idobligaciones`<'43'";
        $database =Config::get('database.connections.'.Config::get('database.default'));
        $database_name=$database['database'];
        $database_host = $database['host'];
        $database_password =  $database['password'];
        $database_user =  $database['username'];
        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
        $resultanomob=mysqli_query($conn,$query);
		while ($row = mysqli_fetch_array($resultanomob )){
        $idobligaciones=$row["idobligaciones"];
        $table=$row["tabla_obligacion"];
        $nombre=$row["nombre"];
                 
                    
                
                $query1="SELECT * FROM $table t where t.`fecha` like '$ano%'";	
                    
                echo $query1."<br>";
		
		$database =Config::get('database.connections.'.Config::get('database.default'));
                $database_name=$database['database'];
                $database_host = $database['host'];
                $database_password =  $database['password'];
                $database_user =  $database['username'];
                $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                $resulcar2=mysqli_query($conn,$query1);
               
                while ($row = mysqli_fetch_array($resulcar2)){
                        
                         
                 if($idobligaciones=='41' or $idobligaciones=='42'){
                         
                                 $campo1=$row[0];
                                 $campo2=$row[1];
                                 $campo3=$row[2];
                                 $campo4=$row[3];
                                 $campo5=$row[4];
                                 $campo6=$row[5];
                                 $campo7=$row[6];
                                 //$campo8=$row[7];
                                 //$campo9=$row[8];
                                 //$campo10=$row[9];
                                // $campo11=$row[10];
                                 $fechan= explode('-',$campo2);
                               $anoold=$fechan[0];
                               $mes=$fechan[1];
                               $dia=$fechan[2];
                               $anof=$ano+1;
                               $fechaf=$anof."-".$mes."-".$dia;
                                 //echo "id:".$campo1." fecha: ".$campo2." cliente: ".$campo3." userweb: ".$campo4." fecharev: ".$campo5." ".$campo6." ".$campo7." ".$campo8." ".$campo9."<br>";
                                 $campo5="";
                                 $campo6="";
                                 $campo7="";				 	  	  
                                $querybusqusuarioweb="SELECT `idusuario_web_encargado` FROM `cliente_has_obligaciones` WHERE `cliente_idcliente`='$campo3' and `obligaciones_idobligaciones`='$idobligaciones'";
                                $database =Config::get('database.connections.'.Config::get('database.default'));
                                $database_name=$database['database'];
                                $database_host = $database['host'];
                                $database_password =  $database['password'];
                                $database_user =  $database['username'];
                                $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                $resultadosusuarioweb=mysqli_query($conn,$querybusqusuarioweb);
                               
                               
                                 while ($row = mysqli_fetch_array($resultadosusuarioweb)){
                                       $idusuario_web_encargado=$row["idusuario_web_encargado"];
                                        }
                                        
                                 $campo4=$idusuario_web_encargado;
                                 $querycf="insert into $table VALUES ('','$fechaf','$campo3','$campo4','$campo5','$campo6','$campo7'); ";
                                 //echo $idobligaciones."<br>";
                                 //echo $querycf."<br>";
                                $resultado=$resultado."<br>"."Reagendado para el cliente:".$campo3." ".$fechaf." ".$table."<br>";

                                $database =Config::get('database.connections.'.Config::get('database.default'));
                                $database_name=$database['database'];
                                $database_host = $database['host'];
                                $database_password =  $database['password'];
                                $database_user =  $database['username'];
                                $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                $resultadoscf=mysqli_query($conn,$querycf);
                                
                           
                          }
                 if($idobligaciones=='27'){
                         
                                 $campo1=$row[0];
                                 $campo2=$row[1];
                                 $campo3=$row[2];
                                 $campo4=$row[3];
                                 $campo5=$row[4];
                                 $campo6=$row[5];
                                 $campo7=$row[6];
                                 $campo8=$row[7];
                                 $campo9=$row[8];
                                 
                                 $fechan= explode('-',$campo2);
                               $anoold=$fechan[0];
                               $mes=$fechan[1];
                               $dia=$fechan[2];
                               $anof=$ano+1;
                               $fechaf=$anof."-".$mes."-".$dia;
                                 //echo "id:".$campo1." fecha: ".$campo2." cliente: ".$campo3." userweb: ".$campo4." fecharev: ".$campo5." ".$campo6." ".$campo7." ".$campo8." ".$campo9."<br>";
                                 $campo5="";
                                 $campo6="";
                                 $campo9="";				 	  	  
                                $querybusqusuarioweb="SELECT `idusuario_web_encargado` FROM `cliente_has_obligaciones` WHERE `cliente_idcliente`='$campo3' and `obligaciones_idobligaciones`='$idobligaciones'";
                                $database =Config::get('database.connections.'.Config::get('database.default'));
                                $database_name=$database['database'];
                                $database_host = $database['host'];
                                $database_password =  $database['password'];
                                $database_user =  $database['username'];
                                $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                $resultadosusuarioweb=mysqli_query($conn,$querybusqusuarioweb);
                            
                                 while ($row = mysqli_fetch_array($resultadosusuarioweb)){
                                       $idusuario_web_encargado=$row["idusuario_web_encargado"];
                                        }
                                        
                                 $campo4=$idusuario_web_encargado;
                                 $querycf="insert into $table VALUES (null,'$fechaf','$campo3','$campo4','0000-00-00 00:00:00','0','$campo7','$campo8','0'); ";
                                 echo $idobligaciones."<br>";
                                 echo $querycf."<br>";
                                $resultado=$resultado."<br>"."Reagendado para el cliente:".$campo3." ".$fechaf." ".$table."<br>";
                                $database =Config::get('database.connections.'.Config::get('database.default'));
                                $database_name=$database['database'];
                                $database_host = $database['host'];
                                $database_password =  $database['password'];
                                $database_user =  $database['username'];
                                $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                $resultadoscf=mysqli_query($conn,$querycf);
                                
                           
                          }		
                          
                 if($idobligaciones=='39'or $idobligaciones=='40'){
                         
                                 $campo1=$row[0];
                                 $campo2=$row[1];
                                 $campo3=$row[2];
                                 $campo4=$row[3];
                                 $campo5=$row[4];
                                 $campo6=$row[5];
                                 $campo7=$row[6];
                                 $campo8=$row[7];
                                 $campo9=$row[8];
                                 $campo10=$row[9];
                                 
                                 $fechan= explode('-',$campo2);
                               $anoold=$fechan[0];
                               $mes=$fechan[1];
                               $dia=$fechan[2];
                               $anof=$ano+1;
                               $fechaf=$anof."-".$mes."-".$dia;
                                 //echo "id:".$campo1." fecha: ".$campo2." cliente: ".$campo3." userweb: ".$campo4." fecharev: ".$campo5." ".$campo6." ".$campo7." ".$campo8." ".$campo9."<br>";
                                 $campo5="";
                                 $campo9="";
                                 $campo10="";
                                $querybusqusuarioweb="SELECT `idusuario_web_encargado` FROM `cliente_has_obligaciones` WHERE `cliente_idcliente`='$campo3' and `obligaciones_idobligaciones`='$idobligaciones'";
                                $database =Config::get('database.connections.'.Config::get('database.default'));
                                $database_name=$database['database'];
                                $database_host = $database['host'];
                                $database_password =  $database['password'];
                                $database_user =  $database['username'];
                                $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                $resultadosusuarioweb=mysqli_query($conn,$querybusqusuarioweb);
                            
                                 while ($row = mysqli_fetch_array($resultadosusuarioweb)){
                                
                                       $idusuario_web_encargado=$row["idusuario_web_encargado"];
                                        }
                                        
                                 $campo4=$idusuario_web_encargado;
                                 $querycf="insert into $table VALUES ('','$fechaf','$campo3','$campo4','$campo5','$campo6','$campo7','$campo8','$campo9','$campo10'); ";
                                 //echo $idobligaciones."<br>";
                                 //echo $querycf."<br>";
                                $resultado=$resultado."<br>"."Reagendado para el cliente:".$campo3." ".$fechaf." ".$table."<br>";
                                $database =Config::get('database.connections.'.Config::get('database.default'));
                                $database_name=$database['database'];
                                $database_host = $database['host'];
                                $database_password =  $database['password'];
                                $database_user =  $database['username'];
                                $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                $resultadocf=mysqli_query($conn,$querycf);
                           
                          }						
                 if($idobligaciones=='32' or $idobligaciones=='37' or $idobligaciones=='38'){
                         
                                 $campo1=$row[0];
                                 $campo2=$row[1];
                                 $campo3=$row[2];
                                 $campo4=$row[3];
                                 $campo5=$row[4];
                                 $campo6=$row[5];
                                 $campo7=$row[6];
                                 $campo8=$row[7];
                                 $campo9=$row[8];
                                 
                                 $fechan= explode('-',$campo2);
                               $anoold=$fechan[0];
                               $mes=$fechan[1];
                               $dia=$fechan[2];
                               $anof=$ano+1;
                               $fechaf=$anof."-".$mes."-".$dia;
                                 //echo "id:".$campo1." fecha: ".$campo2." cliente: ".$campo3." userweb: ".$campo4." fecharev: ".$campo5." ".$campo6." ".$campo7." ".$campo8." ".$campo9."<br>";
                                 $campo7="";
                                 $campo8="";
                                 $campo9="";
                                $querybusqusuarioweb="SELECT `idusuario_web_encargado` FROM `cliente_has_obligaciones` WHERE `cliente_idcliente`='$campo5' and `obligaciones_idobligaciones`='$idobligaciones'";
                                $database =Config::get('database.connections.'.Config::get('database.default'));
                                $database_name=$database['database'];
                                $database_host = $database['host'];
                                $database_password =  $database['password'];
                                $database_user =  $database['username'];
                                $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                $resultadosusuarioweb=mysqli_query($conn,$querybusqusuarioweb);
                            
                                 while ($row = mysqli_fetch_array($resultadosusuarioweb)){
                                       $idusuario_web_encargado=$row["idusuario_web_encargado"];
                                        }
                                        
                                 $campo6=$idusuario_web_encargado;
				$querycf="insert into $table VALUES (null,'$fechaf','$campo3','$campo4','$campo5','$campo6','0000-00-00 00:00:00','0','0'); ";
				
				if($idobligaciones=='38'){
					
				$querycf="insert into $table VALUES (null,'$fechaf','$campo3','$campo4','$campo5','$campo6','$campo7','0000-00-00 00:00:00','0','0'); ";
					
				}
                                 echo $idobligaciones."<br>";
                                 echo $querycf."<br>";
                                $resultado=$resultado."<br>"."Reagendado para el cliente:".$campo5." ".$fechaf." ".$table."<br>";
                                $database =Config::get('database.connections.'.Config::get('database.default'));
                                $database_name=$database['database'];
                                $database_host = $database['host'];
                                $database_password =  $database['password'];
                                $database_user =  $database['username'];
                                $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                $resultadocf=mysqli_query($conn,$querycf);
                           
                          }							
                 if($idobligaciones=='33'){
                         
                                 $campo1=$row[0];
                                 $campo2=$row[1];
                                 $campo3=$row[2];
                                 $campo4=$row[3];
                                 $campo5=$row[4];
                                 $campo6=$row[5];
                                 $campo7=$row[6];
                                 $campo8=$row[7];
                                 $campo9=$row[8];
                                 $campo10=$row[9];
                                
                                 $fechan= explode('-',$campo2);
                               $anoold=$fechan[0];
                               $mes=$fechan[1];
                               $dia=$fechan[2];
                               $anof=$ano+1;
                               $fechaf=$anof."-".$mes."-".$dia;
                                 //echo "id:".$campo1." fecha: ".$campo2." cliente: ".$campo3." userweb: ".$campo4." fecharev: ".$campo5." ".$campo6." ".$campo7." ".$campo8." ".$campo9."<br>";
                                 $campo7="";
                                 $campo9="";
                                 $campo10="";
                                $querybusqusuarioweb="SELECT `idusuario_web_encargado` FROM `cliente_has_obligaciones` WHERE `cliente_idcliente`='$campo5' and `obligaciones_idobligaciones`='$idobligaciones'";
                                $database =Config::get('database.connections.'.Config::get('database.default'));
                                $database_name=$database['database'];
                                $database_host = $database['host'];
                                $database_password =  $database['password'];
                                $database_user =  $database['username'];
                                $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                $resultadosusuarioweb=mysqli_query($conn,$querybusqusuarioweb);
                            
                                 while ($row = mysqli_fetch_array($resultadosusuarioweb)){
                                       $idusuario_web_encargado=$row["idusuario_web_encargado"];
                                        }
                                        
                                 $campo6=$idusuario_web_encargado;
                                 $querycf="insert into $table VALUES (null,'$fechaf','$campo3','$campo4','$campo5','$campo6','0000-00-00 00:00:00','$campo8','0','0'); ";
                                 echo $idobligaciones."<br>";
                                 echo $querycf."<br>";
                                $resultado=$resultado."<br>"."Reagendado para el cliente:".$campo5." ".$fechaf." ".$table."<br>";
                                $database =Config::get('database.connections.'.Config::get('database.default'));
                                $database_name=$database['database'];
                                $database_host = $database['host'];
                                $database_password =  $database['password'];
                                $database_user =  $database['username'];
                                $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                $resultadocf=mysqli_query($conn,$querycf);
                           
                          }
                 if($idobligaciones=='28'){
                         
                                 $campo1=$row[0];
                                 $campo2=$row[1];
                                 $campo3=$row[2];
                                 $campo4=$row[3];
                                 $campo5=$row[4];
                                 $campo6=$row[5];
                                 $campo7=$row[6];
                                 $campo8=$row[7];
                                 $campo9=$row[8];
                                 $campo10=$row[9];
                                // $campo11=$row[10];
                                 $fechan= explode('-',$campo2);
                               $anoold=$fechan[0];
                               $mes=$fechan[1];
                               $dia=$fechan[2];
                               $anof=$ano+1;
                               $fechaf=$anof."-".$mes."-".$dia;
                                 //echo "id:".$campo1." fecha: ".$campo2." cliente: ".$campo3." userweb: ".$campo4." fecharev: ".$campo5." ".$campo6." ".$campo7." ".$campo8." ".$campo9."<br>";
                                 $campo8="";
                                 $campo9="";
                                 $campo10="";
                                $querybusqusuarioweb="SELECT `idusuario_web_encargado` FROM `cliente_has_obligaciones` WHERE `cliente_idcliente`='$campo6' and `obligaciones_idobligaciones`='$idobligaciones'";
                                $database =Config::get('database.connections.'.Config::get('database.default'));
                                $database_name=$database['database'];
                                $database_host = $database['host'];
                                $database_password =  $database['password'];
                                $database_user =  $database['username'];
                                $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                $resultadosusuarioweb=mysqli_query($conn,$querybusqusuarioweb);
                            
                                 while ($row = mysqli_fetch_array($resultadosusuarioweb)){
                                       $idusuario_web_encargado=$row["idusuario_web_encargado"];
                                        }
                                        
                                 $campo7=$idusuario_web_encargado;
                                 $querycf="insert into $table VALUES (null,'$fechaf','$campo3','$campo4','$campo5','$campo6','$campo7','0000-00-00 00:00:00','0','0'); ";
                                 echo $idobligaciones."<br>";
                                 echo $querycf."<br>";
                                $resultado=$resultado."<br>"."Reagendado para el cliente:".$campo6." ".$fechaf." ".$table."<br>";
                                $database =Config::get('database.connections.'.Config::get('database.default'));
                                $database_name=$database['database'];
                                $database_host = $database['host'];
                                $database_password =  $database['password'];
                                $database_user =  $database['username'];
                                $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                $resultadocf=mysqli_query($conn,$querycf);
                           
                          }
                 if($idobligaciones=='29'){
                         
                                 $campo1=$row[0];
                                 $campo2=$row[1];
                                 $campo3=$row[2];
                                 $campo4=$row[3];
                                 $campo5=$row[4];
                                 $campo6=$row[5];
                                 $campo7=$row[6];
                                 $campo8=$row[7];
                                 $campo9=$row[8];
                                 $campo10=$row[9];
                                 $campo11=$row[10];
                                 $fechan= explode('-',$campo2);
                               $anoold=$fechan[0];
                               $mes=$fechan[1];
                               $dia=$fechan[2];
                               $anof=$ano+1;
                               $fechaf=$anof."-".$mes."-".$dia;
                                 //echo "id:".$campo1." fecha: ".$campo2." cliente: ".$campo3." userweb: ".$campo4." fecharev: ".$campo5." ".$campo6." ".$campo7." ".$campo8." ".$campo9."<br>";
                                 $campo9="";
                                 $campo10="";
                                 $campo11="";
                                $querybusqusuarioweb="SELECT `idusuario_web_encargado` FROM `cliente_has_obligaciones` WHERE `cliente_idcliente`='$campo7' and `obligaciones_idobligaciones`='$idobligaciones'";
                                $database =Config::get('database.connections.'.Config::get('database.default'));
                                $database_name=$database['database'];
                                $database_host = $database['host'];
                                $database_password =  $database['password'];
                                $database_user =  $database['username'];
                                $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                $resultadosusuarioweb=mysqli_query($conn,$querybusqusuarioweb);
                            
                                 while ($row = mysqli_fetch_array($resultadosusuarioweb)){
                                       $idusuario_web_encargado=$row["idusuario_web_encargado"];
                                        }
                                        
                                 $campo8=$idusuario_web_encargado;
                                 $querycf="insert into $table VALUES (null,'$fechaf','$campo3','$campo4','$campo5','$campo6','$campo7','$campo8','0000-00-00 00:00:00','0','0'); ";
                                 echo $idobligaciones."<br>";
                                 echo $querycf."<br>";
                                 $resultado=$resultado."<br>"."Reagendado para el cliente:".$campo7." ".$fechaf." ".$table."<br>";
                                 $database =Config::get('database.connections.'.Config::get('database.default'));
                                 $database_name=$database['database'];
                                 $database_host = $database['host'];
                                 $database_password =  $database['password'];
                                 $database_user =  $database['username'];
                                 $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                 $resultadocf=mysqli_query($conn,$querycf);
                           
                          }				 	 
                 if($idobligaciones=='30' or $idobligaciones=='31' or $idobligaciones=='34' or $idobligaciones=='35' or $idobligaciones=='36'){
                         
                                 $campo1=$row[0];
                                 $campo2=$row[1];
                                 $campo3=$row[2];
                                 $campo4=$row[3];
                                 $campo5=$row[4];
                                 $campo6=$row[5];
                                 $campo7=$row[6];
                                 $campo8=$row[7];
                                 $campo9=$row[8];
                                 $campo10=$row[9];
                                 //$campo11=$row[10];
                                 $fechan= explode('-',$campo3);
                               $anoold=$fechan[0];
                               $mes=$fechan[1];
                               $dia=$fechan[2];
                               $anof=$ano+1;
                               $fechaf=$anof."-".$mes."-".$dia;
                                 //echo "id:".$campo1." fecha: ".$campo2." cliente: ".$campo3." userweb: ".$campo4." fecharev: ".$campo5." ".$campo6." ".$campo7." ".$campo8." ".$campo9."<br>";
                                 $campo8="";
                                 $campo9="";
                                 $campo10="";
                                $querybusqusuarioweb="SELECT `idusuario_web_encargado` FROM `cliente_has_obligaciones` WHERE `cliente_idcliente`='$campo6' and `obligaciones_idobligaciones`='$idobligaciones'";
                                $querybusqusuarioweb="SELECT `idusuario_web_encargado` FROM `cliente_has_obligaciones` WHERE `cliente_idcliente`='$campo7' and `obligaciones_idobligaciones`='$idobligaciones'";
                                $database =Config::get('database.connections.'.Config::get('database.default'));
                                $database_name=$database['database'];
                                $database_host = $database['host'];
                                $database_password =  $database['password'];
                                $database_user =  $database['username'];
                                $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                $resultadosusuarioweb=mysqli_query($conn,$querybusqusuarioweb);
                            
                                 while ($row = mysqli_fetch_array($resultadosusuarioweb)){
                                       $idusuario_web_encargado=$row["idusuario_web_encargado"];
                                        }
                                        
                                 $campo7=$idusuario_web_encargado;
                                 $querycf="insert into $table VALUES (null,'$campo2','$fechaf','$campo4','$campo5','$campo6','$campo7','0000-00-00 00:00:00','0','0'); ";
                                 echo $idobligaciones."<br>";
                                 echo $querycf."<br>";
                                 $resultado=$resultado."<br>"."Reagendado para el cliente:".$campo6." ".$fechaf." ".$table."<br>";
                                 $database =Config::get('database.connections.'.Config::get('database.default'));
                                 $database_name=$database['database'];
                                 $database_host = $database['host'];
                                 $database_password =  $database['password'];
                                 $database_user =  $database['username'];
                                 $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                 $resultadocf=mysqli_query($conn,$querycf);
                           
                          }					 	 
                            
                        
                }
                
        
                
        }
    
        $resultado=$resultado."<br>"."Se Reagendo Correctamente PERIODICAS"."<br>";
        //echo $resultado;
        return redirect('admin/asignaperiodica')->with('mensaje', $resultado);


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
