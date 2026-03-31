<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use PhpParser\Node\Expr\Isset_;

class ServObligacionesController extends Controller
{
    //
    public function mostrar(Request $request)
    {
        //
        //dd($request);
        $database =Config::get('database.connections.'.Config::get('database.default'));
        $database_name=$database['database'];
        $database_host = $database['host'];
        $database_password =  $database['password'];
        $database_user =  $database['username'];
        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
        
        $nit = $request->input("nit");
        $tipo = $request->input("tipo");
        $now = Carbon::now()->format('Y-m-d');
        $dosultimos=substr($nit,-2);
        $ultimo=substr($nit,-1);
        $digitos='';
        
        
        $rfin='';
        $rinicio='';   
        //dd($tipo);
        if($tipo=="1"){
            $query="SELECT `Id_Oblig_Dina_almacenadas`, `idObligacion`,`Digitos`,(SELECT n.`nombre` FROM `obligaciones`n WHERE n.`idobligaciones`=`idObligacion`)AS Nombre,`fecha`,`Numero`,`caracteristicas` FROM `obligaciones_dinamicas_almacenadas` WHERE `fecha`>=now() and `fecha`<= DATE(DATE_ADD(now(), INTERVAL 6 MONTH)) and  `idObligacion`!='60'and 
            `idObligacion`!='61' and `idObligacion`!='62'and `idObligacion`!='63'and `idObligacion`!='64'and `idObligacion`!='65'and `idObligacion`!='66'
            order by `fecha`";
        //dd($query);
        }
        if($tipo=="2"){
        
            $query="SELECT `Id_Oblig_Dina_almacenadas`, `idObligacion`,`Digitos`,(SELECT n.`nombre` FROM `obligaciones`n WHERE n.`idobligaciones`=`idObligacion`)AS Nombre,`fecha`,`Numero`,`caracteristicas` FROM `obligaciones_dinamicas_almacenadas` WHERE `fecha`>=now() and `fecha`<= DATE(DATE_ADD(now(), INTERVAL 6 MONTH))  order by `fecha`";
            //dd($query);
            }
        //dd($query);
        $resultbusq = mysqli_query($conn, $query);
        //dd($resultbusq);
        $data = array();
        while ($row = mysqli_fetch_array($resultbusq)) {
                
                $id=$row["Id_Oblig_Dina_almacenadas"];
                $idobligacion=$row["idObligacion"];
                $caracteristicas=$row["caracteristicas"];
                $digitos=$row["Digitos"];
                $fecha = utf8_encode($row["fecha"]);
                $campo= explode("-", $caracteristicas);
                $rinicio=$campo[0];
                $rfin=$campo[1]; 
                if(isset($campo[2])){  $tipo=$campo[2]; }
                $Nombre = utf8_encode($row["Nombre"]);
                    if($idobligacion >= '60' and $idobligacion<='66'){
                        $queryobl="SELECT `Departamento`,`Municipio` FROM `tipo_municipio` WHERE `id_tipo_municipio`='$tipo'";
                        $resultbusqobli = mysqli_query($conn, $queryobl);
                        
                            while ($row = mysqli_fetch_array($resultbusqobli)) {
                                    $Departamento=$row["Departamento"];
                                    $Municipio=$row["Municipio"];
                                    $Nombre = $Nombre.'-'.$Municipio;
                                }

                    }
                
                
                
                $prueba= $id." ".$Nombre." ".$fecha." ".$idobligacion." ".$caracteristicas." ini".$rinicio." digitos".$digitos." fin".$rfin." ".$nit." tipo ".$tipo;
                //$data[] = array_unique(array("dato" => $prueba));
                if($rinicio<=$ultimo and $rfin>=$ultimo and $digitos=='-1'){
                   // $data[] = array_unique(array("dato" => $prueba));
                   // $data[] = array_unique(array("id"=> $id, "Nombre" => $Nombre, "fecha" => $fecha, "inicio" => $rinicio, "fin" => $rfin, "Digito" =>$ultimo));
                    $data[] = array_unique(array("Nombre" => $Nombre, "fecha" => $fecha));
     
                }
                if($rinicio<=$dosultimos and $rfin>=$dosultimos and $digitos=='-2'){
                
                   //$data[] = array_unique(array("dato" => $prueba));
                   //$data[] = array_unique(array("id"=> $id,"Nombre" => $Nombre, "fecha" => $fecha, "inicio" => $rinicio, "fin" => $rfin, "Digito" =>$dosultimos));
                    $data[] = array_unique(array("Nombre" => $Nombre, "fecha" => $fecha));
                }
                
               // $datasinduplicados = [];
               // foreach($data as $elemento) {
                //    if (!in_array($elemento, $datasinduplicados)) {
                //        $datasinduplicados[] = $elemento;
                 //   }

               // }
            
        }

        //return response()->json($datasinduplicados);
        return response()->json($data);

       
    }

}
