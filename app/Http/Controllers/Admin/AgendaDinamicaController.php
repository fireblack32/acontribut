<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\obligaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class AgendaDinamicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $obligacionesdin=obligaciones::orderBy('nombre', 'ASC')->where('DinamicaC', 1)->pluck('idobligaciones','nombre');
        return view('admin.agendadinamica.index', compact('obligacionesdin'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index2($id,$tabla)
    {
        //
        $usuarioweb=session()->get('usuario');
        //dd($tabla);
        $obligacion='';
        $database =Config::get('database.connections.'.Config::get('database.default'));
            $database_name=$database['database'];
            $database_host = $database['host'];
            $database_password =  $database['password'];
            $database_user =  $database['username'];
            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);

            $query="SELECT `idobligaciones` FROM `obligaciones` WHERE `tabla_obligacion`='$tabla'";
            echo $query;

           //dd($query);
            $resultbusq=mysqli_query($conn,$query);

            while($row=mysqli_fetch_array($resultbusq)){
                $obligacion=$row["idobligaciones"];
              }

                if($obligacion=="16" or $obligacion=="43" or $obligacion=="44" or $obligacion=="57"  or $obligacion=="59"){
                                                        
                   
                    $queryrent="SELECT `fecha`, `Digitos`, `Numero`, `idObligacion`, `Dias_H_Encargado`, `Dias_H_Cliente`, `caracteristicas` FROM `obligaciones_dinamicas_almacenadas` WHERE `Id_Oblig_Dina_almacenadas`='$id'";
          	  	            //echo $queryrent;          	  
                            $resultbusq=mysqli_query($conn,$queryrent);
                            while ($row = mysqli_fetch_array($resultbusq)){
                            $theDate=$row["fecha"];
                            $digitos=$row["Digitos"];
                            $idObligacion=$row["idObligacion"];
                            $declararen=$row["caracteristicas"];
                            $campo= explode('-',$declararen);
                            $rinicio=isset($campo[0]) ? $campo[0] : '';
                            $rfin=isset($campo[1]) ? $campo[1] : '';
                            $tipodeclaracion=isset($campo[2]) ? $campo[2] : '';
                            $diash=$row["Dias_H_Encargado"];
                            $diasp=$row["Dias_H_Cliente"];

                       
                            }
                    $query="SELECT `cliente_idcliente`, `idusuario_web_encargado` FROM `cliente_has_obligaciones` WHERE `obligaciones_idobligaciones`=".$idObligacion."";
                            
                            echo $query."<br>";
                            $resultbusq = mysqli_query($conn,$query);
                           
                            while($row=mysqli_fetch_array($resultbusq)){
                            $documento=$row["cliente_idcliente"];
                            echo $documento."<br>";
                            $usuarioren=$row["idusuario_web_encargado"];
                            if($digitos>0){
                            $digitos=$digitos*-1;
                            }			
                            $restos=substr($documento,$digitos);
                        	echo "inicio".$rinicio." fin".$rfin." restos: ".$restos." digitos: ".$digitos;
                            for($i=$rinicio;$i<=$rfin;$i++){
                            if($i==$restos){	
                                $query2="INSERT INTO $tabla (`id`, `fecha`,`tipo_declaracion_renta` ,`cliente_idcliente`, `idusuario_web`, `fecha_rev`, `Dias_H_Cliente`, `Dias_H_Encargado`)	  VALUES (null,'$theDate','$tipodeclaracion','$documento','$usuarioren',Now(),'$diash','$diasp')";
                                echo $query2;
                                $result = mysqli_query($conn,$query2);
                                if (!$result) {
                                printf("Error: %s\n", mysqli_error($conn));
                                
                                }else{
                                echo"Item Creado para el cliente ".$documento."<br>";
                                }
                            
                                }
                                }		
            
                                
                            }
                            $queryact="UPDATE `obligaciones_dinamicas_almacenadas` SET `Agenda` = '1' WHERE `obligaciones_dinamicas_almacenadas`.`Id_Oblig_Dina_almacenadas` ='$id'";
                            $resultbusq=mysqli_query($conn,$queryact);
                            return redirect('admin/agendinamica')->with('mensaje', 'Se agendaron las obligaciones con éxito ');
    
                    
                }

                if($obligacion=="18"){
                
                    $queryrent="SELECT `fecha`, `Digitos`, `Numero`, `idObligacion`, `Dias_H_Encargado`, `Dias_H_Cliente`, `caracteristicas` FROM `obligaciones_dinamicas_almacenadas` WHERE `Id_Oblig_Dina_almacenadas`='$id'";
                    //echo "inicia aca: ".$queryrent.'<tr>';

                       //echo $queryrent;          	           	  
                       $resultbusq=mysqli_query($conn,$queryrent);
                       while ($row = mysqli_fetch_array($resultbusq)){
                       $theDate=$row["fecha"];
                       $digitos=$row["Digitos"];
                       $idObligacion=$row["idObligacion"];
                       $declararen=$row["caracteristicas"];
                       $campo= explode('-',$declararen);
                       $tipodeclaracion=isset($campo[2]) ? $campo[2] : '';
                       $rinicio=isset($campo[0]) ? $campo[0] : '';
                       $rfin=isset($campo[1]) ? $campo[1] : '';
                       $diash=$row["Dias_H_Encargado"];
                       $diasp=$row["Dias_H_Cliente"];

                  
                       }
                       $query="SELECT `cliente_idcliente`, `idusuario_web_encargado` FROM `cliente_has_obligaciones` WHERE `obligaciones_idobligaciones`=".$idObligacion."";
                       echo $query."<br>";
                   
                            $resultbusq = mysqli_query($conn,$query);
                      
                                while($row=mysqli_fetch_array($resultbusq)){
                                    //dd($query);
                                $documento=$row["cliente_idcliente"];
                                echo $documento."<br>";
                                $usuarioren=$row["idusuario_web_encargado"];
                                if($digitos>0){
                                $digitos=$digitos*-1;
                                }			
                                $restos=substr($documento,$digitos);
                                    echo "inicio".$rinicio." fin".$rfin." restos: ".$restos." digitos: ".$digitos;
                                for($i=$rinicio;$i<=$rfin;$i++){

                                if($i==$restos){	
                                    $query2="INSERT INTO $tabla (`id`, `fecha`, `cliente_idcliente`, `idusuario_web`, `fecha_rev`, `Dias_H_Cliente`, `Dias_H_Encargado`,`tipo_soi`,`Estado`)  VALUES (null,'$theDate','$documento','$usuarioren',Now(),'$diash','$diasp','$tipodeclaracion','0')";
                                    echo $query2;
                                    $result = mysqli_query($conn,$query2);
                                    if (!$result) {
                                    printf("Error: %s\n", mysqli_error($conn));
                                    
                                    }else{
                                    echo"Item Creado para el cliente ".$documento."<br>";
                                        }
                                        
                                    }
                                    }		
     
                       }
                    
                       $queryact="UPDATE `obligaciones_dinamicas_almacenadas` SET `Agenda` = '1' WHERE `obligaciones_dinamicas_almacenadas`.`Id_Oblig_Dina_almacenadas` ='$id'";
                        $resultbusq=mysqli_query($conn,$queryact);
                        return redirect('admin/agendinamica')->with('mensaje', 'Se agendaron las obligaciones con éxito ');
            
                    
                }

                if($obligacion=="19"){

                    $queryrent="SELECT `fecha`, `Digitos`, `Numero`, `idObligacion`, `Dias_H_Encargado`, `Dias_H_Cliente`, `caracteristicas` FROM `obligaciones_dinamicas_almacenadas` WHERE `Id_Oblig_Dina_almacenadas`='$id'";
                    //echo $querytab.'<tr>';

                       //echo $queryrent;          	  
                       $resultbusq=mysqli_query($conn,$queryrent);
                       while ($row = mysqli_fetch_array($resultbusq)){
                       $theDate=$row["fecha"];
                       $digitos=$row["Digitos"];
                       $idObligacion=$row["idObligacion"];
                       $declararen=$row["caracteristicas"];
                       $campo= explode('-',$declararen);
                       $rinicio=isset($campo[0]) ? $campo[0] : '';
                       $rfin=isset($campo[1]) ? $campo[1] : '';
                       $tipodeclaracion=isset($campo[2]) ? $campo[2] : '';
                       $diash=$row["Dias_H_Encargado"];
                       $diasp=$row["Dias_H_Cliente"];
                       }
                       $query="SELECT `cliente_idcliente`, `idusuario_web_encargado` FROM `cliente_has_obligaciones` WHERE `obligaciones_idobligaciones`=".$idObligacion."";
                       
                       //echo $query."<br>";
                       $resultbusq = mysqli_query($conn,$query);
                    
                       while($row=mysqli_fetch_array($resultbusq)){
                       $documento=$row["cliente_idcliente"];
                       //echo $documento."<br>";
                       $usuarioren=$row["idusuario_web_encargado"];
                       if($digitos>0){
                       $digitos=$digitos*-1;
                       }			
                       $restos=substr($documento,$digitos);
                   //	echo "inicio".$rinicio." fin".$rfin." restos: ".$restos." digitos: ".$digitos;
                       for($i=$rinicio;$i<=$rfin;$i++){
                       if($i==$restos){	
                           $query2="INSERT INTO $tabla (`id`, `fecha`,`idsucursal_cliente`,`tipo_ica_idtipo_ica`,`cliente_idcliente`, `idusuario_web`, `fecha_rev`, `Dias_H_Cliente`, `Dias_H_Encargado`)  VALUES (null,'$theDate','0','$tipodeclaracion','$documento','$usuarioren',Now(),'$diash','$diasp')";
                           echo $query2;
                           $result = mysqli_query($conn,$query2);
                           if (!$result) {
                           printf("Error: %s\n", mysqli_error($conn));
                                    
                           }else{
                           echo"Item Creado para el cliente ".$documento."<br>";
                           }
                       
                           }
                        }		
        
                        }
                    
                       $queryact="UPDATE `obligaciones_dinamicas_almacenadas` SET `Agenda` = '1' WHERE `obligaciones_dinamicas_almacenadas`.`Id_Oblig_Dina_almacenadas` ='$id'";
                        $resultbusq=mysqli_query($conn,$queryact);
                        return redirect('admin/agendinamica')->with('mensaje', 'Se agendaron las obligaciones con éxito');
                    
                }

                

                if($obligacion=="22"){
                
                    $queryrent="SELECT `fecha`, `Digitos`, `Numero`, `idObligacion`, `Dias_H_Encargado`, `Dias_H_Cliente`, `caracteristicas` FROM `obligaciones_dinamicas_almacenadas` WHERE `Id_Oblig_Dina_almacenadas`='$id'";
                    //echo $querytab.'<tr>';

                       //echo $queryrent;          	  
                       $resultbusq=mysqli_query($conn,$queryrent);
                       while ($row = mysqli_fetch_array($resultbusq)){
                       $theDate=$row["fecha"];
                       $digitos=$row["Digitos"];
                       $idObligacion=$row["idObligacion"];
                       $declararen=$row["caracteristicas"];
                       $campo= explode('-',$declararen);
                       $rinicio=isset($campo[0]) ? $campo[0] : '';
                       $rfin=isset($campo[1]) ? $campo[1] : '';
                       $tipodeclaracion=isset($campo[2]) ? $campo[2] : '';
                       $valor=isset($campo[3]) ? $campo[3] : '';
                       $diash=$row["Dias_H_Encargado"];
                       $diasp=$row["Dias_H_Cliente"];
                       }
                       $query="SELECT `cliente_idcliente`, `idusuario_web_encargado` FROM `cliente_has_obligaciones` WHERE `obligaciones_idobligaciones`=".$idObligacion."";
                       
                       //echo $query."<br>";
                       $resultbusq = mysqli_query($conn,$query);
                       
                       while($row=mysqli_fetch_array($resultbusq)){
                       $documento=$row["cliente_idcliente"];
                       //echo $documento."<br>";
                       $usuarioren=$row["idusuario_web_encargado"];
                       if($digitos>0){
                       $digitos=$digitos*-1;
                       }			
                       $restos=substr($documento,$digitos);
                   //	echo "inicio".$rinicio." fin".$rfin." restos: ".$restos." digitos: ".$digitos;
                       for($i=$rinicio;$i<=$rfin;$i++){
                       if($i==$restos){	
                           $query2="INSERT INTO $tabla (`id`, `valor` ,`fecha`,`idtipo_impuesto_patrimonio`,`cliente_idcliente`, `idusuario_web`, `fecha_rev`, `Dias_H_Cliente`, `Dias_H_Encargado`)  
                           VALUES (null,'$valor','$theDate','$tipodeclaracion','$documento','$usuarioren',Now(),'$diash','$diasp')";
                           echo $query2;
                           $result = mysqli_query($conn,$query2);
                           if (!$result) {
                           printf("Error: %s\n", mysqli_error($conn));
                                    
                           }else{
                           echo"Item Creado para el cliente ".$documento."<br>";
                           }
                       
                           }
                            }		
            
                            }
                        
                        $queryact="UPDATE `obligaciones_dinamicas_almacenadas` SET `Agenda` = '1' WHERE `obligaciones_dinamicas_almacenadas`.`Id_Oblig_Dina_almacenadas` ='$id'";
                        $resultbusq=mysqli_query($conn,$queryact);
            
                        return redirect('admin/agendinamica')->with('mensaje', 'Se agendaron las obligaciones con éxito');
                }

                if($obligacion=="23"){
                
                    $queryrent="SELECT `fecha`, `Digitos`, `Numero`, `idObligacion`, `Dias_H_Encargado`, `Dias_H_Cliente`, `caracteristicas` FROM `obligaciones_dinamicas_almacenadas` WHERE `Id_Oblig_Dina_almacenadas`='$id'";
                    //echo $querytab.'<tr>';

                       //echo $queryrent;          	  
                       $resultbusq=mysqli_query($conn,$queryrent);
                       while ($row = mysqli_fetch_array($resultbusq)){
                       $theDate=$row["fecha"];
                       $digitos=$row["Digitos"];
                       $idObligacion=$row["idObligacion"];
                       $declararen=$row["caracteristicas"];
                       $campo= explode('-',$declararen);
                       $rinicio=isset($campo[0]) ? $campo[0] : '';
                       $rfin=isset($campo[1]) ? $campo[1] : '';
                       $tipodeclaracion=isset($campo[2]) ? $campo[2] : '';
                       $diash=$row["Dias_H_Encargado"];
                       $diasp=$row["Dias_H_Cliente"];
                       }
                       $query="SELECT `cliente_idcliente`, `idusuario_web_encargado` FROM `cliente_has_obligaciones` WHERE `obligaciones_idobligaciones`=".$idObligacion."";
                       
                       //echo $query."<br>";
                       $resultbusq = mysqli_query($conn,$query);
                    
                       while($row=mysqli_fetch_array($resultbusq)){
                       $documento=$row["cliente_idcliente"];
                       //echo $documento."<br>";
                       $usuarioren=$row["idusuario_web_encargado"];
                       if($digitos>0){
                       $digitos=$digitos*-1;
                       }			
                       $restos=substr($documento,$digitos);
                   //	echo "inicio".$rinicio." fin".$rfin." restos: ".$restos." digitos: ".$digitos;
                       for($i=$rinicio;$i<=$rfin;$i++){
                       if($i==$restos){	
                           $query2="INSERT INTO $tabla (`id`, `fecha`,`idtipo_rete_fuente`,`cliente_idcliente`, `idusuario_web`, `fecha_rev`, `Dias_H_Cliente`, `Dias_H_Encargado`)  
                           VALUES (null,'$theDate','$tipodeclaracion','$documento','$usuarioren',Now(),'$diash','$diasp')";
                           echo $query2;
                           $result = mysqli_query($conn,$query2);
                           if (!$result) {
                           printf("Error: %s\n", mysqli_error($conn));
                                    
                           }else{
                           echo"Item Creado para el cliente ".$documento."<br>";
                           }
                       
                           }
                       }		
        
                        }
                        
                       $queryact="UPDATE `obligaciones_dinamicas_almacenadas` SET `Agenda` = '1' WHERE `obligaciones_dinamicas_almacenadas`.`Id_Oblig_Dina_almacenadas` ='$id'";
                       $resultbusq=mysqli_query($conn,$queryact);
                       return redirect('admin/agendinamica')->with('mensaje', 'Se agendaron las obligaciones con éxito');
                
                }

                if($obligacion=="25"){
                
                    $queryrent="SELECT `fecha`, `Digitos`, `Numero`, `idObligacion`, `Dias_H_Encargado`, `Dias_H_Cliente`, `caracteristicas` FROM `obligaciones_dinamicas_almacenadas` WHERE `Id_Oblig_Dina_almacenadas`='$id'";
                    //echo $querytab.'<tr>';

                       //echo $queryrent;          	  
                       $resultbusq=mysqli_query($conn,$queryrent);
                       while ($row = mysqli_fetch_array($resultbusq)){
                       $theDate=$row["fecha"];
                       $digitos=$row["Digitos"];
                       $idObligacion=$row["idObligacion"];
                       $declararen=$row["caracteristicas"];
                       $campo= explode('-',$declararen);
                       $rinicio=isset($campo[0]) ? $campo[0] : '';
                       $rfin=isset($campo[1]) ? $campo[1] : '';
                       $tipodeclaracion=isset($campo[2]) ? $campo[2] : '';
                       $diash=$row["Dias_H_Encargado"];
                       $diasp=$row["Dias_H_Cliente"];
                       }
                       $query="SELECT `cliente_idcliente`, `idusuario_web_encargado` FROM `cliente_has_obligaciones` WHERE `obligaciones_idobligaciones`=".$idObligacion."";
                       
                       //echo $query."<br>";
                       $resultbusq = mysqli_query($conn,$query);
                
                       while($row=mysqli_fetch_array($resultbusq)){
                       $documento=$row["cliente_idcliente"];
                       //echo $documento."<br>";
                       $usuarioren=$row["idusuario_web_encargado"];
                       if($digitos>0){
                       $digitos=$digitos*-1;
                       }			
                       $restos=substr($documento,$digitos);
                   //	echo "inicio".$rinicio." fin".$rfin." restos: ".$restos." digitos: ".$digitos;
                       for($i=$rinicio;$i<=$rfin;$i++){
                       if($i==$restos){	
                           $query2="INSERT INTO $tabla (`id`, `fecha`,`idtipo_super_sociedades`,`cliente_idcliente`, `idusuario_web`, `fecha_rev`, `Dias_H_Cliente`, `Dias_H_Encargado`)  
                           VALUES (null,'$theDate','$tipodeclaracion','$documento','$usuarioren',Now(),'$diash','$diasp')";
                           echo $query2;
                           $result = mysqli_query($conn,$query2);
                           if (!$result) {
                           printf("Error: %s\n", mysqli_error($conn));
                                    
                           }else{
                           echo"Item Creado para el cliente ".$documento."<br>";
                           }
                       
                           }
                       }		
     
                       }
                    
                       $queryact="UPDATE `obligaciones_dinamicas_almacenadas` SET `Agenda` = '1' WHERE `obligaciones_dinamicas_almacenadas`.`Id_Oblig_Dina_almacenadas` ='$id'";
                       $resultbusq=mysqli_query($conn,$queryact);
                       return redirect('admin/agendinamica')->with('mensaje', 'Se agendaron las obligaciones con éxito');
                
                }

                if($obligacion=="17" or $obligacion=="20" or $obligacion=="21" or $obligacion=="24" or $obligacion=="26" or $obligacion=="45" or $obligacion=="46" or $obligacion=="47" or $obligacion=="48" or $obligacion=="49" or $obligacion=="50" or $obligacion=="51" or $obligacion=="52" or $obligacion=="53" or $obligacion=="54" or $obligacion=="55" or $obligacion=="56" or $obligacion=="58" or $obligacion=="67" or $obligacion=="68"  or $obligacion=="69"  or $obligacion=="70"  or $obligacion=="71"  or $obligacion=="72" or $obligacion=="73"){
                
                    $queryrent="SELECT `fecha`, `Digitos`, `Numero`, `idObligacion`, `Dias_H_Encargado`, `Dias_H_Cliente`, `caracteristicas` FROM `obligaciones_dinamicas_almacenadas` WHERE `Id_Oblig_Dina_almacenadas`='$id'";
                    //echo $queryrent;          	  
                        $resultbusq=mysqli_query($conn,$queryrent);
                        while ($row = mysqli_fetch_array($resultbusq)){
                        $theDate=$row["fecha"];
                        $digitos=$row["Digitos"];
                        $idObligacion=$row["idObligacion"];
                        $declararen=$row["caracteristicas"];
                        $campo= explode('-',$declararen);
                        $rinicio=isset($campo[0]) ? $campo[0] : '';
                        $rfin=isset($campo[1]) ? $campo[1] : '';
                        $tipodeclaracion=isset($campo[2]) && !empty($campo[2]) ? $campo[2] : '0';
                        $diash=$row["Dias_H_Encargado"];
                        $diasp=$row["Dias_H_Cliente"];
                    
                
                        }
                        $query="SELECT `cliente_idcliente`, `idusuario_web_encargado` FROM `cliente_has_obligaciones` WHERE `obligaciones_idobligaciones`=".$idObligacion."";
                        
                        //echo $query."<br>";
                        $resultbusq = mysqli_query($conn,$query);
                    
                        while($row=mysqli_fetch_array($resultbusq)){
                        $documento=$row["cliente_idcliente"];
                        //echo $documento."<br>";
                        $usuarioren=$row["idusuario_web_encargado"];
                        if($digitos>0){
                        $digitos=$digitos*-1;
                        }			
                        $restos=substr($documento,$digitos);
                    //	echo "inicio".$rinicio." fin".$rfin." restos: ".$restos." digitos: ".$digitos;
                        for($i=$rinicio;$i<=$rfin;$i++){
                        if($i==$restos){	
                            $query2="INSERT INTO $tabla (`id`, `fecha`, `cliente_idcliente`, `idusuario_web`, `fecha_rev`, `Dias_H_Cliente`, `Dias_H_Encargado`,`Estado`)  VALUES (null,'$theDate','$documento','$usuarioren',Now(),'$diash','$diasp','0')";
                            echo $query2;
                            $result = mysqli_query($conn,$query2);
                            if (!$result) {
                            printf("Error: %s\n", mysqli_error($conn));
                                     
                            }else{
                            echo"Item Creado para el cliente ".$documento."<br>";
                            }
                        
                            }
                        }		

                        }
                    
                        $queryact="UPDATE `obligaciones_dinamicas_almacenadas` SET `Agenda` = '1' WHERE `obligaciones_dinamicas_almacenadas`.`Id_Oblig_Dina_almacenadas` ='$id'";
                        $resultbusq=mysqli_query($conn,$queryact);
                        return redirect('admin/agendinamica')->with('mensaje', 'se agendo la obligación exito');
                    
                }

                if($obligacion=="60" or $obligacion=="61" or $obligacion=="62" or $obligacion=="63" or $obligacion=="64" or $obligacion=="65" or $obligacion=="66"){
                
                    $queryrent="SELECT `fecha`, `Digitos`, `Numero`, `idObligacion`, `Dias_H_Encargado`, `Dias_H_Cliente`, `caracteristicas` FROM `obligaciones_dinamicas_almacenadas` WHERE `Id_Oblig_Dina_almacenadas`='$id'";
                    //echo $queryrent;          	  
                        $resultbusq=mysqli_query($conn,$queryrent);
                        while ($row = mysqli_fetch_array($resultbusq)){
                        $theDate=$row["fecha"];
                        $digitos=$row["Digitos"];
                        $idObligacion=$row["idObligacion"];
                        $declararen=$row["caracteristicas"];
                        $campo= explode('-',$declararen);
                        $rinicio=isset($campo[0]) ? $campo[0] : '';
                        $rfin=isset($campo[1]) ? $campo[1] : '';
                        $municipio=isset($campo[2]) ? $campo[2] : '';
                        $tipodeclaracion=isset($campo[2]) ? $campo[2] : '';
                        $diash=$row["Dias_H_Encargado"];
                        $diasp=$row["Dias_H_Cliente"];
                    
                
                        }
                         $query="SELECT `cliente_idcliente`, `idusuario_web_encargado` FROM `cliente_has_obligaciones` WHERE `obligaciones_idobligaciones`=".$idObligacion."";
                        
                        //echo $query."<br>";
                        $resultbusq = mysqli_query($conn,$query);
                     
                        while($row=mysqli_fetch_array($resultbusq)){
                        $documento=$row["cliente_idcliente"];
                        //echo $documento."<br>";
                        $usuarioren=$row["idusuario_web_encargado"];
                        if($digitos>0){
                        $digitos=$digitos*-1;
                        }			
                        $restos=substr($documento,$digitos);
                    //	echo "inicio".$rinicio." fin".$rfin." restos: ".$restos." digitos: ".$digitos;
                        for($i=$rinicio;$i<=$rfin;$i++){
                        if($i==$restos){	
                        
                        $querymun="SELECT `idmunicipio` FROM `cliente_has_municipio` WHERE `idcliente`=".$documento."";
                        $resultmun = mysqli_query($conn,$querymun);
                     
                        while($row=mysqli_fetch_array($resultmun)){
                            $municipioasig=$row["idmunicipio"];
                            
                            if($municipio==$municipioasig){

                            $query2="INSERT INTO $tabla (`id`, `fecha`, `cliente_idcliente`, `idusuario_web`, `fecha_rev`, `Dias_H_Cliente`, `Dias_H_Encargado`,`Municipio`,`Estado`)  
                            VALUES (null,'$theDate','$documento','$usuarioren',Now(),'$diash','$diasp','$municipio','0')";
                            echo $query2;
                            $result = mysqli_query($conn,$query2);
                            if (!$result) {
                            printf("Error: %s\n", mysqli_error($conn));
                                     
                            }else{
                            echo"Item Creado para el cliente ".$documento."<br>";
                            }
                        }

                        }

                        
                            }
                        }		

                        }
                    
                        $queryact="UPDATE `obligaciones_dinamicas_almacenadas` SET `Agenda` = '1' WHERE `obligaciones_dinamicas_almacenadas`.`Id_Oblig_Dina_almacenadas` ='$id'";
                        $resultbusq=mysqli_query($conn,$queryact);
                        return redirect('admin/agendinamica')->with('mensaje', 'Se agendaron las obligaciones con éxito');
            
                    
                }

        if($obligacion>="74" and $obligacion<="87"){
                
                    $queryrent="SELECT `fecha`, `Digitos`, `Numero`, `idObligacion`, `Dias_H_Encargado`, `Dias_H_Cliente`, `caracteristicas` FROM `obligaciones_dinamicas_almacenadas` WHERE `Id_Oblig_Dina_almacenadas`='$id'";
                    //echo $queryrent;          	  
                        $resultbusq=mysqli_query($conn,$queryrent);
                        while ($row = mysqli_fetch_array($resultbusq)){
                        $theDate=$row["fecha"];
                        $digitos=$row["Digitos"];
                        $idObligacion=$row["idObligacion"];
                        $declararen=$row["caracteristicas"];
                        $campo= explode('-',$declararen);
                        $rinicio=isset($campo[0]) ? $campo[0] : '';
                        $rfin=isset($campo[1]) ? $campo[1] : '';
                        $tipodeclaracion=isset($campo[2]) && !empty($campo[2]) ? $campo[2] : '0';
                        $diash=$row["Dias_H_Encargado"];
                        $diasp=$row["Dias_H_Cliente"];
                    
                
                        }
                        $query="SELECT `cliente_idcliente`, `idusuario_web_encargado` FROM `cliente_has_obligaciones` WHERE `obligaciones_idobligaciones`=".$idObligacion."";
                        
                        //echo $query."<br>";
                        $resultbusq = mysqli_query($conn,$query);
                    
                        while($row=mysqli_fetch_array($resultbusq)){
                        $documento=$row["cliente_idcliente"];
                        //echo $documento."<br>";
                        $usuarioren=$row["idusuario_web_encargado"];
                        if($digitos>0){
                        $digitos=$digitos*-1;
                        }			
                        $restos=substr($documento,$digitos);
                    //	echo "inicio".$rinicio." fin".$rfin." restos: ".$restos." digitos: ".$digitos;
                        for($i=$rinicio;$i<=$rfin;$i++){
                        if($i==$restos){	
                            $query2="INSERT INTO $tabla (`id`, `fecha`, `cliente_idcliente`, `idusuario_web`, `fecha_rev`, `Dias_H_Cliente`, `Dias_H_Encargado`,`Estado`)  VALUES (null,'$theDate','$documento','$usuarioren',Now(),'$diash','$diasp','0')";
                            echo $query2;
                            $result = mysqli_query($conn,$query2);
                            if (!$result) {
                            printf("Error: %s\n", mysqli_error($conn));
                                     
                            }else{
                            echo"Item Creado para el cliente ".$documento."<br>";
                            }
                        
                            }
                        }		

                        }
                    
                        $queryact="UPDATE `obligaciones_dinamicas_almacenadas` SET `Agenda` = '1' WHERE `obligaciones_dinamicas_almacenadas`.`Id_Oblig_Dina_almacenadas` ='$id'";
                        $resultbusq=mysqli_query($conn,$queryact);
                        return redirect('admin/agendinamica')->with('mensaje', 'se agendo la obligación exito');
                    
        }
        if($obligacion>="88" or $obligacion<="94"){
                
                    $queryrent="SELECT `fecha`, `Digitos`, `Numero`, `idObligacion`, `Dias_H_Encargado`, `Dias_H_Cliente`, `caracteristicas` FROM `obligaciones_dinamicas_almacenadas` WHERE `Id_Oblig_Dina_almacenadas`='$id'";
                    //dd($queryrent);          	  
                        $resultbusq=mysqli_query($conn,$queryrent);
                        while ($row = mysqli_fetch_array($resultbusq)){
                        $theDate=$row["fecha"];
                        $digitos=$row["Digitos"];
                        $idObligacion=$row["idObligacion"];
                        $declararen=$row["caracteristicas"];
                        $campo= explode('-',$declararen);
                        $rinicio=isset($campo[0]) ? $campo[0] : '';
                        $rfin=isset($campo[1]) ? $campo[1] : '';
                        $tipodeclaracion=isset($campo[2]) && !empty($campo[2]) ? $campo[2] : '0';
                        $diash=$row["Dias_H_Encargado"];
                        $diasp=$row["Dias_H_Cliente"];
                    
                
                        }
                        $query="SELECT `cliente_idcliente`, `idusuario_web_encargado` FROM `cliente_has_obligaciones` WHERE `obligaciones_idobligaciones`=".$idObligacion."";
                        
                        //echo $query."<br>";
                        $resultbusq = mysqli_query($conn,$query);
                    
                        while($row=mysqli_fetch_array($resultbusq)){
                        $documento=$row["cliente_idcliente"];
                        //echo $documento."<br>";
                        $usuarioren=$row["idusuario_web_encargado"];
                        if($digitos>0){
                        $digitos=$digitos*-1;
                        }			
                        $restos=substr($documento,$digitos);
                    //	echo "inicio".$rinicio." fin".$rfin." restos: ".$restos." digitos: ".$digitos;
                        for($i=$rinicio;$i<=$rfin;$i++){
                        if($i==$restos){	
                            $query2="INSERT INTO $tabla (`id`, `fecha`,`idtipo` ,`cliente_idcliente`, `idusuario_web`, `fecha_rev`, `Dias_H_Cliente`, `Dias_H_Encargado`,`Estado`)  
                            VALUES (null,'$theDate','$tipodeclaracion','$documento','$usuarioren',Now(),'$diash','$diasp','0')";
                            //dd($query2);
                            $result = mysqli_query($conn,$query2);
                            if (!$result) {
                            printf("Error: %s\n", mysqli_error($conn));
                                     
                            }else{
                            echo"Item Creado para el cliente ".$documento."<br>";
                            }
                        
                            }
                        }		

                        }
                    
                        $queryact="UPDATE `obligaciones_dinamicas_almacenadas` SET `Agenda` = '1' WHERE `obligaciones_dinamicas_almacenadas`.`Id_Oblig_Dina_almacenadas` ='$id'";
                        $resultbusq=mysqli_query($conn,$queryact);
                        return redirect('admin/agendinamica')->with('mensaje', 'se agendo la obligación exito');
                    
        }


     }
      
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
