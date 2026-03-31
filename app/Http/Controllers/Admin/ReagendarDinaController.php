<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class ReagendarDinaController extends Controller
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
        
        return view('admin.reagendardina.index', compact('cliente'));
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
        $idusuarioweb=DB::select('select id from usuario_web where usuario = ?', [$usuarioweb]);
        $usuarioweb=implode('', array_column($idusuarioweb, 'id'));
            
        $idob='';
        $resultado='';
        $querycar='';
        $querymos='';
        $municipio='';
        $declararen='';
        $nombreobl='';
        $cliente = $request->input("cliente");
        $queryprincipal="SELECT `Id_Oblig_Dina_almacenadas`, `fecha`, `Digitos`, `Numero`, `idObligacion`, `Dias_H_Encargado`, `Dias_H_Cliente`, `caracteristicas`, `Agenda` 
        FROM `obligaciones_dinamicas_almacenadas` WHERE `fecha`>= CURDATE() and `Agenda`='1' order by `fecha`";
        
        //echo $queryprincipal;
        //dd($queryprincipal);
        $database =Config::get('database.connections.'.Config::get('database.default'));
        $database_name=$database['database'];
        $database_host = $database['host'];
        $database_password =  $database['password'];
        $database_user =  $database['username'];
        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
        $resultsprinc=mysqli_query($conn,$queryprincipal);
                    
        while($row=mysqli_fetch_array($resultsprinc)){ 
        $id=$row["Id_Oblig_Dina_almacenadas"];
        $fecha=$row["fecha"];
        $Digitos=$row["Digitos"];
                
        $numero=$row["Numero"];
        $idObligacion=$row["idObligacion"];
        $Dias_H_Encargado=$row["Dias_H_Encargado"];
        $Dias_H_Cliente=$row["Dias_H_Cliente"];
        $caracteristicas=$row["caracteristicas"];
        $Agenda=$row["Agenda"]; 
        $restos=substr($cliente,$Digitos);
                
        $queryasig="SELECT `obligaciones_idobligaciones` FROM `cliente_has_obligaciones` 
        WHERE `cliente_idcliente`='$cliente' and `obligaciones_idobligaciones`='$idObligacion'";
        echo $queryasig."<br>";
        //dd($queryasig);	    
        $ingreso=0;	    
        $database =Config::get('database.connections.'.Config::get('database.default'));
        $database_name=$database['database'];
        $database_host = $database['host'];
        $database_password =  $database['password'];
        $database_user =  $database['username'];
        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
        $resultsasig=mysqli_query($conn,$queryasig);
        while($row=mysqli_fetch_array($resultsasig)){ 
            $ingreso=$row["obligaciones_idobligaciones"];
        }
            if($ingreso!=0 or $ingreso!="" or $ingreso==17 or $ingreso==19 or $ingreso==20 or $ingreso==22 or $ingreso==23 or $ingreso==24 or $ingreso==25 or $ingreso==26)
            {
         // echo "ingreso: ".$ingreso." restos: ".$restos." Numero".$numero."<br>";
		    if($numero==$restos){ 
                $queryus="SELECT `idusuario_web_encargado` FROM `cliente_has_obligaciones` WHERE `cliente_idcliente`='$cliente' 
				and `obligaciones_idobligaciones`='$idObligacion'";
				$database =Config::get('database.connections.'.Config::get('database.default'));
                $database_name=$database['database'];
                $database_host = $database['host'];
                $database_password =  $database['password'];
                $database_user =  $database['username'];
                $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                $resultsusu=mysqli_query($conn,$queryus);
                while($row=mysqli_fetch_array($resultsusu)){ 
                    $usuarioenc=$row["idusuario_web_encargado"];

                }
                if($usuarioenc!=""){
                    $idsuarioweb=$usuarioenc;
                    }else{

                        $queryus="SELECT  `idusuario_web`  FROM `cliente` WHERE `idcliente`='$cliente'";
                        $database =Config::get('database.connections.'.Config::get('database.default'));
                        $database_name=$database['database'];
                        $database_host = $database['host'];
                        $database_password =  $database['password'];
                        $database_user =  $database['username'];
                        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                        $resultsusu=mysqli_query($conn,$queryus);
                        while($row=mysqli_fetch_array($resultsusu)){
                            $usuarioenc=$row["idusuario_web"];  
                        }

                        $idsuarioweb=$usuarioenc;
                    }
                    if($ingreso=='17'){
                        $querycar="Insert Into  `obd_superintendencia_salud` (`fecha`, `cliente_idcliente`, `idusuario_web`, `fecha_rev`, `Dias_H_Cliente`, `Dias_H_Encargado`, `Estado`, `agenda`)
                        values ('$fecha','$cliente','$idsuarioweb',Now(),'$Dias_H_Cliente','$Dias_H_Encargado','0','0')";
                        //echo "oblig 17: ".$querycar;
                        $querymos=$querymos."<br>".$querycar;
                        $queryNomob="SELECT `nombre` FROM `obligaciones` WHERE `idobligaciones`='$ingreso'";
                        $database =Config::get('database.connections.'.Config::get('database.default'));
                        $database_name=$database['database'];
                        $database_host = $database['host'];
                        $database_password =  $database['password'];
                        $database_user =  $database['username'];
                        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                        $resultsnom=mysqli_query($conn,$queryNomob);
                        
                        while ($row = mysqli_fetch_array($resultsnom )){
                             $nombreobl=$row["nombre"];
         
                             }
                         
                        $resultado=$resultado."<br>"."<p align=left>Item Creado ".$nombreobl." para el cliente ".$cliente." en la fecha ".$fecha."<br></p>";
                        
                       }

                    
                    if($ingreso=='19'){
                         $campo= explode('-',$caracteristicas);
                         $sucursal=$campo[0];
                         $tipoica=$campo[1];
                         $querycar="insert into  `obd_ica` (`fecha`, `idsucursal_cliente`, `tipo_ica_idtipo_ica`, `cliente_idcliente`, `idusuario_web`, `fecha_rev`, `Dias_H_Cliente`, `Dias_H_Encargado`, `Estado`, `agenda`)
                         values('$fecha','0','$tipoica','$cliente','$idsuarioweb',Now(),'$Dias_H_Cliente','$Dias_H_Encargado','0','0')";
                         $querymos=$querymos."<br>".$querycar;
                         //echo "Oblig 19: ".$querycar;
                         $queryNomob="SELECT `nombre` FROM `obligaciones` WHERE `idobligaciones`='$ingreso'";
                         $database =Config::get('database.connections.'.Config::get('database.default'));
                         $database_name=$database['database'];
                         $database_host = $database['host'];
                         $database_password =  $database['password'];
                         $database_user =  $database['username'];
                         $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                         $resultsnom=mysqli_query($conn,$queryNomob);
                         while ($row = mysqli_fetch_array($resultsnom )){
                         $nombreobl=$row["nombre"];
                            
                         }
                     
                         $resultado=$resultado."<br>"."<p align=left>Item Creado ".$nombreobl." para el cliente ".$cliente." en la fecha ".$fecha."<br></p>";
                    }

                    if($ingreso=='20'){
                         $querycar="insert into  `obd_iva` (`fecha`, `cliente_idcliente`, `idusuario_web`, `fecha_rev`, `Dias_H_Cliente`, `Dias_H_Encargado`, `Estado`, `agenda`)
                         values('$fecha','$cliente','$idsuarioweb',Now(),'$Dias_H_Cliente','$Dias_H_Encargado','0','0')";
                         $querymos=$querycar."<br>".$querycar;
                            echo "Oblig 20: ".$querycar;
                         $queryNomob="SELECT `nombre` FROM `obligaciones` WHERE `idobligaciones`='$ingreso'";
                         $database =Config::get('database.connections.'.Config::get('database.default'));
                         $database_name=$database['database'];
                         $database_host = $database['host'];
                         $database_password =  $database['password'];
                         $database_user =  $database['username'];
                         $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                         $resultsnom=mysqli_query($conn,$queryNomob);
                         while ($row = mysqli_fetch_array($resultsnom )){
                         $nombreobl=$row["nombre"];
                            
                         }
                         
                         $resultado=$resultado."<br>"."<p align=left>Item Creado ".$nombreobl." para el cliente ".$cliente." en la fecha ".$fecha."<br></p>";
                    }

                    if($ingreso=='22'){
			 	 	     $campo= explode('-',$caracteristicas);
			 	   	     $tipo=$campo[0];
			 	   	     $valor=$campo[1];
			 	   	     $querycar="insert into  `obd_impuesto_patrimonio` (`fecha`, `valor`, `idtipo_impuesto_patrimonio`, `cliente_idcliente`, `idusuario_web`, `fecha_rev`, `Dias_H_Cliente`, `Dias_H_Encargado`, `Estado`, `agenda`)
			 	 	     values('$fecha','$valor','$tipo','$cliente','$idsuarioweb',Now(),'$Dias_H_Cliente','$Dias_H_Encargado','0','0')";
                         $querymos=$querymos."<br>".$querycar;
                         echo "Oblig 22: ".$querycar;
			 	 	     $queryNomob="SELECT `nombre` FROM `obligaciones` WHERE `idobligaciones`='$ingreso'";
                         $database =Config::get('database.connections.'.Config::get('database.default'));
                         $database_name=$database['database'];
                         $database_host = $database['host'];
                         $database_password =  $database['password'];
                         $database_user =  $database['username'];
                         $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                         $resultsnom=mysqli_query($conn,$queryNomob);
					     while ($row = mysqli_fetch_array($resultsnom )){
						 $nombreobl=$row["nombre"];
		
						 }
						
                         $resultado=$resultado."<br>"."<p align=left>Item Creado ".$nombreobl." para el cliente ".$cliente." en la fecha ".$fecha."<br></p>";
                      }
                      

		    if($ingreso=='23'){
			    //echo "ingreso aca: ".$ingreso;
                         $campo= explode('-',$caracteristicas);
			 	   	     $tipo=$campo[2];
                         $querycar="insert into  `obd_rete_fuente` (`fecha`, `cliente_idcliente`, `idusuario_web`, `fecha_rev`, `Dias_H_Cliente`, `Dias_H_Encargado`,`idtipo_rete_fuente`, `Estado`, `agenda`)
                         values('$fecha','$cliente','$idsuarioweb',Now(),'$Dias_H_Cliente','$Dias_H_Encargado','$tipo','0','0')";
                         $querymos=$querymos."<br>".$querycar;
                         echo "Oblig 23: ".$querycar;
                         $queryNomob="SELECT `nombre` FROM `obligaciones` WHERE `idobligaciones`='$ingreso'";
                         $database =Config::get('database.connections.'.Config::get('database.default'));
                         $database_name=$database['database'];
                         $database_host = $database['host'];
                         $database_password =  $database['password'];
                         $database_user =  $database['username'];
                         $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                         $resultsnom=mysqli_query($conn,$queryNomob);
					     while ($row = mysqli_fetch_array($resultsnom )){
                         $nombreobl=$row["nombre"];
                            
                         }
                         
                         $resultado=$resultado."<br>"."<p align=left>Item Creado ".$nombreobl." para el cliente ".$cliente." en la fecha ".$fecha."<br></p>";
                    }  


                    if($ingreso=='24'){
                         $querycar="insert into `obd_rete_ica` (`fecha`, `cliente_idcliente`, `idusuario_web`, `fecha_rev`, `Dias_H_Cliente`, `Dias_H_Encargado`, `Estado`, `agenda`)
                         values('$fecha','$cliente','$idsuarioweb',Now(),'$Dias_H_Cliente','$Dias_H_Encargado','0','0')";
                         $querymos=$querymos."<br>".$querycar;
                         echo "Oblig 24: ".$querycar;
                         $queryNomob="SELECT `nombre` FROM `obligaciones` WHERE `idobligaciones`='$ingreso'";
                         $database =Config::get('database.connections.'.Config::get('database.default'));
                         $database_name=$database['database'];
                         $database_host = $database['host'];
                         $database_password =  $database['password'];
                         $database_user =  $database['username'];
                         $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                         $resultsnom=mysqli_query($conn,$queryNomob);
					     while ($row = mysqli_fetch_array($resultsnom )){
                         $nombreobl=$row["nombre"];
                            
                         }
                         
                         $resultado=$resultado."<br>"."<p align=left>Item Creado ".$nombreobl." para el cliente ".$cliente." en la fecha ".$fecha."<br></p>";
                    }

                    if($ingreso=='25'){
                         $campo= explode('-',$caracteristicas);
			 	   	     $tipo=$campo[2];
                         $querycar="insert into  `obd_super_sociedades` (`fecha`, `cliente_idcliente`, `idusuario_web`, `fecha_rev`, `Dias_H_Cliente`, `Dias_H_Encargado`,`idtipo_super_sociedades`, `Estado`, `agenda`)
                         values('$fecha','$cliente','$idsuarioweb',Now(),'$Dias_H_Cliente','$Dias_H_Encargado','$tipo','0','0')";
                         $querymos=$querymos."<br>".$querycar;
                         echo "Obliga 25: ".$querycar;
                         $queryNomob="SELECT `nombre` FROM `obligaciones` WHERE `idobligaciones`='$ingreso'";
                         $database =Config::get('database.connections.'.Config::get('database.default'));
                         $database_name=$database['database'];
                         $database_host = $database['host'];
                         $database_password =  $database['password'];
                         $database_user =  $database['username'];
                         $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                         $resultsnom=mysqli_query($conn,$queryNomob);
					     while ($row = mysqli_fetch_array($resultsnom )){
                         $nombreobl=$row["nombre"];
                            
                         }
                         
                         $resultado=$resultado."<br>"."<p align=left>Item Creado ".$nombreobl." para el cliente ".$cliente." en la fecha ".$fecha."<br></p>";
                    }


                    if($ingreso=='26'){
                         $querycar="insert into `obd_cuentas_comp_dian` (`fecha`, `cliente_idcliente`, `idusuario_web`, `fecha_rev`, `Dias_H_Cliente`, `Dias_H_Encargado`, `Estado`, `agenda`)
                         values('$fecha','$cliente','$idsuarioweb',Now(),'$Dias_H_Cliente','$Dias_H_Encargado','0','0')";
                         $querymos=$querymos."<br>".$querycar;
                         echo "Obliga 26: ".$querycar;
                         $queryNomob="SELECT `nombre` FROM `obligaciones` WHERE `idobligaciones`='$ingreso'";
                         $database =Config::get('database.connections.'.Config::get('database.default'));
                         $database_name=$database['database'];
                         $database_host = $database['host'];
                         $database_password =  $database['password'];
                         $database_user =  $database['username'];
                         $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                         $resultsnom=mysqli_query($conn,$queryNomob);
					     while ($row = mysqli_fetch_array($resultsnom )){
                         $nombreobl=$row["nombre"];
                            
                         }
                         
                         $resultado=$resultado."<br>"." <p align=right>Item Creado ".$nombreobl." para el cliente ".$cliente." en la fecha ".$fecha."<br></p>";
                    }
                    echo "Oblig: ".$querycar;
                    $database =Config::get('database.connections.'.Config::get('database.default'));
                    $database_name=$database['database'];
                    $database_host = $database['host'];
                    $database_password =  $database['password'];
                    $database_user =  $database['username'];
                    $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                     if($querycar!=''){
			$resultscar=mysqli_query($conn,$querycar);
		     }
		    

                    }
        }
        
        if($ingreso!=0 or $ingreso!="" and $ingreso==16 or $ingreso==43 or $ingreso==44 or $ingreso==18 or $ingreso==21 or $ingreso==45 or $ingreso==46 or $ingreso==47 or $ingreso==48 or $ingreso==49 or $ingreso==50 or $ingreso==51 or $ingreso==52 or $ingreso==53 or $ingreso==54 or $ingreso==55 or $ingreso==56 or $ingreso==57 or $ingreso==58 or $ingreso==59 or $ingreso==60 or $ingreso==61 or $ingreso==62 or $ingreso==63 or $ingreso==64 or $ingreso==65 or $ingreso==66 or $ingreso==70)
        {
		//echo "Por aca ingreso: ".$ingreso."<br>";
                $queryus="SELECT `idusuario_web_encargado` FROM `cliente_has_obligaciones` WHERE `cliente_idcliente`='$cliente' 
				and `obligaciones_idobligaciones`='$idObligacion'";
                $database =Config::get('database.connections.'.Config::get('database.default'));
                $database_name=$database['database'];
                $database_host = $database['host'];
                $database_password =  $database['password'];
                $database_user =  $database['username'];
                $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                $resultadosus=mysqli_query($conn,$queryus);

                while ($row = mysqli_fetch_array($resultadosus)){
                $usuarioenc=$row["idusuario_web_encargado"];
                }

                if($usuarioenc!=""){
                $idsuarioweb=$usuarioenc;
                }else{
                    $queryus="SELECT  `idusuario_web`  FROM `cliente` WHERE `idcliente`='$cliente'";
                    $database =Config::get('database.connections.'.Config::get('database.default'));
                    $database_name=$database['database'];
                    $database_host = $database['host'];
                    $database_password =  $database['password'];
                    $database_user =  $database['username'];
                    $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                    $resultadosus=mysqli_query($conn,$queryus);
                    while ($row = mysqli_fetch_array($resultadosus)){
                    $usuarioenc=$row["idusuario_web"];
                    }
                    $idsuarioweb=$usuarioenc;
                }

		if($ingreso=='18'){
		//	echo "Por aca ingreso: ".$ingreso."<br>";
				$campo= explode('-',$caracteristicas);
				$numero=$campo[0];
				$numero2=$campo[1];
				$tiposoi=$campo[2];
				//echo "anali Documento:".$idcliente." inicio: ".$numero." numero ".$numero2."<br>";
				for($i=$numero;$i<=$numero2;$i=$i+1){
					//echo "intern Documento:".$idcliente." inicio: ".$i." Restos".$restos."<br>";
                    if($i==$restos){
                        $query2="INSERT INTO `obd_soi`(`fecha`, `cliente_idcliente`, `idusuario_web`, 
                        `fecha_rev`, `Dias_H_Cliente`, `Dias_H_Encargado`,`tipo_soi`)	
                        VALUES ('$fecha','$cliente','$usuarioenc', Now(),$Dias_H_Encargado,$Dias_H_Cliente,$tiposoi)";
			            //echo $query2;
			            echo  "Oblig18 ".$ingreso.":".$query2."<BR>";
                        $database =Config::get('database.connections.'.Config::get('database.default'));
                        $database_name=$database['database'];
                        $database_host = $database['host'];
                        $database_password =  $database['password'];
                        $database_user =  $database['username'];
                        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                        $resultadosus=mysqli_query($conn,$query2);

                        $queryNomob="SELECT `nombre` FROM `obligaciones` WHERE `idobligaciones`='$ingreso'";
                        $database =Config::get('database.connections.'.Config::get('database.default'));
                        $database_name=$database['database'];
                        $database_host = $database['host'];
                        $database_password =  $database['password'];
                        $database_user =  $database['username'];
                        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                        $resultadosus=mysqli_query($conn,$queryNomob);
                        while ($row = mysqli_fetch_array($resultadosus)){
                        $nombreobl=$row["nombre"];
                        }	
                        $resultado=$resultado."<br>"."<p align=left>Item Creado ".$nombreobl." para el cliente ".$cliente." en la fecha ".$fecha."<br></p>";
                    }
                        
                }
					
                }
                if($ingreso=='16' or $ingreso=='43' or $ingreso=='44' or $ingreso=='45' or $ingreso=='46' or $ingreso=='47' or $ingreso=='48' or $ingreso=='49' or $ingreso=='50' or $ingreso=='51' or $ingreso=='52'or $ingreso=='53' or $ingreso=='54' or $ingreso=='55' or $ingreso=='56' or $ingreso=='57' or $ingreso=='58' or  $ingreso=='59' or $ingreso=='60' or $ingreso=='61' or $ingreso=='62' or $ingreso=='63' or $ingreso=='64' or $ingreso=='65' or $ingreso=='66')
                {
					
					$campo= explode('-',$caracteristicas);
					echo "El valor del caracteristicas y obligación: ".$caracteristicas." y ".$ingreso."<br>";
					//echo "El valor del campo: ".$campo[2]."<br>";
					$rinicio=$campo[0];
					$rfin=$campo[1];
					if($ingreso!='16'or $ingreso!='43'or $ingreso!='44' or $ingreso!='47' or $ingreso!='48' or $ingreso!='49' or $ingreso!='50' or $ingreso!='51' or $ingreso!='52' or $ingreso!='53' or $ingreso!='55' or  $ingreso!='54' or  $ingreso!='56'or $ingreso!='57'or $ingreso!='58' or $ingreso!='59'){
						
				
						
					$municipio=@$campo[2] ;
					$declararen=@$campo[2] ;					
					

				
					if($ingreso=='58'){
					$tipocon='58';
					}
					if($ingreso=='59'){
					$tipocon='59';
					}
				    }

					$tipocon=@$campo[3];
					$diash=@$row["Dias_H_Encargado"];
					$diasp=@$row["Dias_H_Cliente"]; 
                    $querytab="SELECT `tabla_obligacion` FROM `obligaciones` WHERE `idobligaciones`='$idObligacion'";
					$database_name=$database['database'];
                    $database_host = $database['host'];
                    $database_password =  $database['password'];
                    $database_user =  $database['username'];
                    $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                    $resultstab=mysqli_query($conn,$querytab);
                    while ($row = mysqli_fetch_array($resultstab))
					$tabla_obligacion=$row["tabla_obligacion"];
                    
                    for($i=$rinicio;$i<=$rfin;$i++){
									
                     //echo "anali Documento:".$idcliente." ingreso".$ingreso." inicio: ".$rinicio." numero ".$rfin."<br>";
                    
                        if($i==$restos){
                        echo "anali Documento:".$cliente." ingreso".$ingreso." inicio: ".$rinicio." numero ".$rfin." Valor i ".$i." restos ".$restos."<br>";
                        if($ingreso==60 or $ingreso=='54' or $ingreso==61 or $ingreso==62 or $ingreso==63 or $ingreso==64 or $ingreso==65 or $ingreso==66){	
                          
                            $querymun = "SELECT co.`cliente_idcliente`, co.`obligaciones_idobligaciones`, co.`idusuario_web`, co.`fecha_rev`, co.`idusuario_web_encargado` 
                            FROM `cliente_has_obligaciones` co, `cliente_has_municipio` cm 
                            WHERE co.`cliente_idcliente`=cm.`idcliente`and cm.`idcliente`='$cliente' and co.`obligaciones_idobligaciones`='$ingreso' and `idmunicipio`='$municipio' 
                            and co.`idusuario_web_encargado`='$idsuarioweb'";
                            //echo  "es:".$querymun."<BR>";
                            $database_name=$database['database'];
                            $database_host = $database['host'];
                            $database_password =  $database['password'];
                            $database_user =  $database['username'];
                            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                            $result=mysqli_query($conn,$querymun);
                            $num_rows = mysqli_num_rows($result);
                                    //echo  "es:".$num_rows;
                                if($num_rows > 0){
                                $query2="INSERT INTO $tabla_obligacion( `fecha`, `cliente_idcliente`,`idusuario_web`, `fecha_rev`, `Dias_H_Encargado`, `Dias_H_Cliente`,`Municipio`)VALUES ('$fecha','$cliente', '$usuarioenc', Now(),'$Dias_H_Encargado','$Dias_H_Cliente','$municipio')";
                                echo  "Oblig6066 ".$ingreso.":".$query2."<BR>";
                                $database_name=$database['database'];
                                $database_host = $database['host'];
                                $database_password =  $database['password'];
                                $database_user =  $database['username'];
                                $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                $result=mysqli_query($conn,$query2);
                                $resultado=$resultado."<br>"."<p align=left>Item Creado ".$nombreobl." para el cliente ".$cliente." en la fecha ".$fecha."<br></p>";
                                }
                                
                            
                        }
                        if($ingreso==16 or $ingreso==43 or $ingreso==57 or $ingreso==44){	
                            $tipocon=@$campo[2] ; 
                            $querymun = "SELECT co.`cliente_idcliente`, co.`obligaciones_idobligaciones`, co.`idusuario_web`, co.`fecha_rev`, co.`idusuario_web_encargado` 
                            FROM `cliente_has_obligaciones` co 
                            WHERE co.`cliente_idcliente`='$cliente' and co.`obligaciones_idobligaciones`='$ingreso' and co.`idusuario_web_encargado`='$idsuarioweb'";
                            echo  "es:".$querymun."<BR>";
                            $database_name=$database['database'];
                            $database_host = $database['host'];
                            $database_password =  $database['password'];
                            $database_user =  $database['username'];
                            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                            $result=mysqli_query($conn,$querymun);
                            $num_rows = mysqli_num_rows($result);
                                    //echo  "es:".$num_rows;
                                if($num_rows > 0){
                                $query2="INSERT INTO $tabla_obligacion( `fecha`, `tipo_declaracion_renta`,`cliente_idcliente`,`idusuario_web`, `fecha_rev`, `Dias_H_Encargado`, `Dias_H_Cliente`)VALUES ('$fecha','$tipocon','$cliente', '$usuarioenc', Now(),'$Dias_H_Encargado','$Dias_H_Cliente')";
                                echo  "Oblig16 ".$ingreso.":".$query2."<BR>";
                                $database_name=$database['database'];
                                $database_host = $database['host'];
                                $database_password =  $database['password'];
                                $database_user =  $database['username'];
                                $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                $result=mysqli_query($conn,$query2);
                                $resultado=$resultado."<br>"."<p align=left>Item Creado ".$nombreobl." para el cliente ".$cliente." en la fecha ".$fecha."<br></p>";
                                }
                                
                            
                        }
                            
                    }
                }
                }
                if($ingreso=='21' or $ingreso=='45' or $ingreso=='46'){
					
					
					$campo= explode('-',$caracteristicas);
					$rinicio=$campo[0];
					$rfin=$campo[1];
					$magneticos=@$campo[2];
					//echo "anali Documento:".$idcliente." ingreso".$ingreso." inicio: ".$rinicio." numero ".$rfin."<br>";
					$querytab="SELECT `tabla_obligacion` FROM `obligaciones` WHERE `idobligaciones`=$idObligacion";
					$database =Config::get('database.connections.'.Config::get('database.default'));
                    $database_name=$database['database'];
                    $database_host = $database['host'];
                    $database_password =  $database['password'];
                    $database_user =  $database['username'];
                    $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                    $resultstab=mysqli_query($conn,$querytab);
                    while ($row = mysqli_fetch_array($resultstab)){
						$tabla_obligacion=$row["tabla_obligacion"];
					}
					for($i=$rinicio;$i<=$rfin;$i++){
					    if($i==$restos){	
                        
						$query2="INSERT INTO $tabla_obligacion (`fecha`, 
						 `cliente_idcliente`, `idusuario_web`, `fecha_rev`, `Dias_H_Cliente`,
						 `Dias_H_Encargado`)VALUES ('$fecha','$cliente','$usuarioenc',Now(),'$Dias_H_Encargado','$Dias_H_Cliente')";
                        

						echo  "Oblig2146 ".$ingreso.":".$query2."<BR>";
						$database =Config::get('database.connections.'.Config::get('database.default'));
                        $database_name=$database['database'];
                        $database_host = $database['host'];
                        $database_password =  $database['password'];
                        $database_user =  $database['username'];
                        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                        $results2=mysqli_query($conn,$query2);
                        
                        $queryNomob="SELECT `nombre` FROM `obligaciones` WHERE `idobligaciones`='$ingreso'";
						$database =Config::get('database.connections.'.Config::get('database.default'));
                        $database_name=$database['database'];
                        $database_host = $database['host'];
                        $database_password =  $database['password'];
                        $database_user =  $database['username'];
                        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                        $resultanomob=mysqli_query($conn,$queryNomob);
						while ($row = mysqli_fetch_array($resultanomob )){
							$nombreobl=$row["nombre"];
						}
						
                        $resultado=$resultado."<br>"."<p align=left>Item Creado ".$nombreobl." para el cliente ".$cliente." en la fecha ".$fecha."<br></p>";
						
						}
					}
				}  

                

                if($ingreso=='47' or $ingreso=='48' or $ingreso=='49' or $ingreso=='50' or $ingreso=='51' or $ingreso=='52' or $ingreso=='53' or $ingreso=='55' or  $ingreso=='56' or $ingreso=='70'){
					echo "solo parte de 48".$ingreso."<br>";
					$campo= explode('-',$caracteristicas);
					$rinicio=$campo[0];
					$rfin=$campo[1];
					$diash=@$row["Dias_H_Encargado"];
					$diasp=@$row["Dias_H_Cliente"];
					
					$querytab="SELECT `tabla_obligacion` FROM `obligaciones` WHERE `idobligaciones`='$idObligacion'";
					$database =Config::get('database.connections.'.Config::get('database.default'));
                    $database_name=$database['database'];
                    $database_host = $database['host'];
                    $database_password =  $database['password'];
                    $database_user =  $database['username'];
                    $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                    $resultadostab=mysqli_query($conn,$querytab);
					while ($row = mysqli_fetch_array($resultadostab)){
					$tabla_obligacion=$row["tabla_obligacion"];
					}
					echo "anali Documento:".$cliente." ingreso".$ingreso." inicio: ".$rinicio." numero ".$rfin."<br>";
					for($i=$rinicio;$i<=$rfin;$i++){
									
					//echo "anali Documento:".$idcliente." ingreso".$ingreso." inicio: ".$rinicio." numero ".$rfin."<br>";
				
					if($i==$restos){
					//echo "anali Documento:".$idcliente." ingreso".$ingreso." inicio: ".$rinicio." numero ".$rfin." Valor i ".$i." restos ".$restos."<br>";
						$query2="INSERT INTO $tabla_obligacion(`fecha`, `cliente_idcliente`, 
						`idusuario_web`, `fecha_rev`, `Dias_H_Encargado`, `Dias_H_Cliente`)	
						VALUES ('$fecha', '$cliente', '$usuarioenc', Now(),$Dias_H_Encargado,$Dias_H_Cliente)";
						 echo  "Oblig4755 ".$ingreso.":".$query2."<BR>";
						$querymos=$querymos."<br>".$query2;
						$database_name=$database['database'];
                        $database_host = $database['host'];
                        $database_password =  $database['password'];
                        $database_user =  $database['username'];
                        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                        $resultados2=mysqli_query($conn,$query2);
					
						$queryNomob="SELECT `nombre` FROM `obligaciones` WHERE `idobligaciones`='$ingreso'";
						$database =Config::get('database.connections.'.Config::get('database.default'));
                        $database_name=$database['database'];
                        $database_host = $database['host'];
                        $database_password =  $database['password'];
                        $database_user =  $database['username'];
                        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                        $resultadosnomb=mysqli_query($conn,$queryNomob);
                        while ($row = mysqli_fetch_array($resultadosnomb)){
							$nombreobl=$row["nombre"];
		
							}
						
                            $resultado=$resultado."<br>"."<p align=left>Item Creado ".$nombreobl." para el cliente ".$querycar." en la fecha ".$fecha."<br></p>";
						
						
						}
					}
		        }
        
                if($ingreso>='88' and $ingreso<='94'){
                            
                    //dd($ingreso);	
                    $campo= explode('-',$caracteristicas);
                    $rinicio=$campo[0];
                    $rfin=$campo[1];
                    $tipo=@$campo[2];
                    //echo "anali Documento:".$idcliente." ingreso".$ingreso." inicio: ".$rinicio." numero ".$rfin."<br>";
                    $querytab="SELECT `tabla_obligacion` FROM `obligaciones` WHERE `idobligaciones`=$idObligacion";
                    $database =Config::get('database.connections.'.Config::get('database.default'));
                    $database_name=$database['database'];
                    $database_host = $database['host'];
                    $database_password =  $database['password'];
                    $database_user =  $database['username'];
                    $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                    $resultstab=mysqli_query($conn,$querytab);
                    while ($row = mysqli_fetch_array($resultstab)){
                        $tabla_obligacion=$row["tabla_obligacion"];
                    }
                    for($i=$rinicio;$i<=$rfin;$i++){
                        if($i==$restos){	
                        
                        $query2="INSERT INTO $tabla_obligacion (`fecha`, 
                        `cliente_idcliente`,`idtipo`,`idusuario_web`, `fecha_rev`, `Dias_H_Cliente`,
                        `Dias_H_Encargado`)VALUES ('$fecha','$cliente','$tipo','$usuarioenc',Now(),'$Dias_H_Encargado','$Dias_H_Cliente')";
                        

                        echo  "Oblig2146 ".$ingreso.":".$query2."<BR>";
                        $database =Config::get('database.connections.'.Config::get('database.default'));
                        $database_name=$database['database'];
                        $database_host = $database['host'];
                        $database_password =  $database['password'];
                        $database_user =  $database['username'];
                        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                        $results2=mysqli_query($conn,$query2);
                        
                        $queryNomob="SELECT `nombre` FROM `obligaciones` WHERE `idobligaciones`='$ingreso'";
                        $database =Config::get('database.connections.'.Config::get('database.default'));
                        $database_name=$database['database'];
                        $database_host = $database['host'];
                        $database_password =  $database['password'];
                        $database_user =  $database['username'];
                        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                        $resultanomob=mysqli_query($conn,$queryNomob);
                        while ($row = mysqli_fetch_array($resultanomob )){
                            $nombreobl=$row["nombre"];
                        }
                        
                        $resultado=$resultado."<br>"."<p align=left>Item Creado ".$nombreobl." para el cliente ".$cliente." en la fecha ".$fecha."<br></p>";
                        
                        }
                    }
                }else{
                $tabla_obligacion="";
                            $query2="INSERT INTO $tabla_obligacion( `fecha`, `tipo_declaracion_renta`,`tipo_con`, `cliente_idcliente`, 
                            `idusuario_web`, `fecha_rev`, `Dias_H_Encargado`, `Dias_H_Cliente`)	
                            VALUES ('$fecha', '$idObligacion', '$declararen','$cliente', '$usuarioenc', Now(),$Dias_H_Encargado,$Dias_H_Cliente)";
                            //echo $query2;
                            echo  "Oblig1663 ".$ingreso.":".$query2."<BR>";
                            $querymos=$querymos."<br>".$query2;
                            $database_name=$database['database'];
                            $database_host = $database['host'];
                            $database_password =  $database['password'];
                            $database_user =  $database['username'];
                            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                            $result=mysqli_query($conn,$query2);

                            $queryNomob="SELECT `nombre` FROM `obligaciones` WHERE `idobligaciones`='$ingreso'";
                            $database =Config::get('database.connections.'.Config::get('database.default'));
                            $database_name=$database['database'];
                            $database_host = $database['host'];
                            $database_password =  $database['password'];
                            $database_user =  $database['username'];
                            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                            $resultsnom=mysqli_query($conn,$queryNomob);
                            while ($row = mysqli_fetch_array($resultsnom )){
                            $nombreobl=$row["nombre"];
                
                            }    
                            $resultado=$resultado."<br>"."<p align=left>Item Creado ".$nombreobl." para el cliente ".$cliente." en la fecha ".$fecha."<br></p>";
                    }


                    }

                
        }


        
            
        
     $resultado=$resultado."<br>"."Se Reagendo Correctamente DINAMICAS".$cliente."<br>";
    // return redirect('admin/asignadinamica')->with('mensaje', $resultado);

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
