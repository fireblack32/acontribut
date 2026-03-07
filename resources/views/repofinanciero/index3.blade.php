@php
$ruta_final="informe_excel_fin(".date('Y-m-d_H:i:s').").xls";
$excelfile=$ruta_final;
@header('Content-type: application/octet-stream'); 
@header('Content-disposition: attachment; filename='.$excelfile);

                            $estadoobl='';
                            $estadoobl1='';
                            $estadoobl2='';
                            $estadoobl3='';
                            $estadoobl4='';
                            $estadoobl5='';
                            $estadoobl6='';
                            $estadoobl7='';
                            $resultadosel='';
                            $querysel='';
                            $queryd2='';
                            $queryd3='';
                            $queryd4='';
                            function fun_eliminarDobleEspacios($cadena)
                                {
                                        $limpia    = "";
                                        $parts    = array();
                                        
                                        // divido la cadena con todos los espacios q haya
                                        $parts = explode(" ",$cadena);
                                        
                                        foreach($parts as $subcadena)
                                        {
                                            // de cada subcadena elimino sus espacios a los lados
                                            $subcadena = trim($subcadena);
                                            
                                            // luego lo vuelvo a unir con un espacio para formar la nueva cadena limpia
                                            // omitir los que sean unicamente espacios en blanco
                                            if($subcadena!="")
                                            { $limpia .= $subcadena." "; }
                                        }
                                        $limpia = trim($limpia);
                                        
                                        return $limpia;
                                } 
                                
                            $usuario_id=session()->get('usuario_id');
                            if ($usuario_id!=''){

                                if ($estadoobl1!=""){
                                $estadoobl1="'Pendiente'";
                                $estadoobl=$estadoobl."  ".$estadoobl1;
                                }
                                
                                
                                if($estadoobl2!=""){
                                $estadoobl2="'En proceso'";
                                $estadoobl=$estadoobl."  ".$estadoobl2;
                                }
                                
                                if($estadoobl3!=""){
                                $estadoobl3="'Finalizada sin Revisi&oacute;n'";
                                $estadoobl=$estadoobl."  ".$estadoobl3;
                                }
                                
                                if($estadoobl4!=""){
                                $estadoobl4="'Segunda Revisi&oacute;n'";
                                $estadoobl=$estadoobl."  ".$estadoobl4;
                                }
                                
                                if($estadoobl5!=""){
                                $estadoobl5="'Revisi&oacute;n SGS'";
                                $estadoobl=$estadoobl."  ".$estadoobl5;
                                }
                                
                                if($estadoobl6!=""){
                                $estadoobl6="'Finalizada con Revisi&oacute;n'";
                                $estadoobl=$estadoobl."  ".$estadoobl6;
                                }
                                
                                if($estadoobl7!=""){
                                $estadoobl7="'Entregado al Cliente'";
                                $estadoobl=$estadoobl."  ".$estadoobl7;
                                }
                                
                                
                                
                                
                                $estadoobl=trim($estadoobl);
                                
                                
                                
                                $estadoobl=explode("  ",$estadoobl);
                                
                                
                                
                                $estadooblf=implode(' or dt.estado= ',$estadoobl);

				
                                    
                                        
                                $queryb="SELECT `idobligaciones`,`nombre`,`tabla_obligacion` FROM `obligaciones` ";
                                   

                                $database =Config::get('database.connections.'.Config::get('database.default'));
                                $database_name=$database['database'];
                                $database_host = $database['host'];
                                $database_password =  $database['password'];
                                $database_user =  $database['username'];
                                $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                $resultooblig=mysqli_query($conn,$queryb);
                            
                                while($row=mysqli_fetch_array($resultooblig)){
                                        
                                    $idobligaciones=$row["idobligaciones"];
                                    $table=$row["tabla_obligacion"];
                                    $nombre=$row["nombre"];
                                    
                                    $queryd1="dt.`idObligacion`=t.`id` 
                                    and  dt.`Tipo_obligacion`='$idobligaciones' 
                                    and t.`cliente_idcliente`=dt.`Cliente`
                                    and dt. `Estado`!='Pendiente' ";


                                    if($Fechaini!=""){
                                        
                                    $queryd2=" "."dt.`fecha`>='$Fechaini'";
                                        
                                    }
                                    
                                    if($Fechafin!=""){
                                    $queryd3=" "."dt.`fecha`<='$Fechafin'";
                                                    
                                    }

                                    if($usuario!=""){
                                    $queryd4=" "."`idusuario_web`='$usuario'";
                                        
                                    }
                                        
                                    $variable=''.$queryd2." ".$queryd3." ".$queryd4;
                                    
                
                                    $miarreglo1=fun_eliminarDobleEspacios($variable);
                                    $miarreglo1=explode(" ",$miarreglo1);
                                    $miarreglo1=implode(" and ",$miarreglo1);
                            
				    if($estadooblf!=""){
				    $estadooblf=$estadooblf.' or estado=""';
                                    $miarreglo1=$miarreglo1." and (dt.estado=".$estadooblf.")";
                                    }


                                    if($miarreglo1==""){
                                        $querybase=$miarreglo1=$queryd1;
                                    }else{   			
                                        $querybase=$queryd1." and ".$miarreglo1;
                                    }

                                    $querybase=$queryd1." and ".$miarreglo1. " order by t.`fecha`,dt.`Cliente`,dt.`Fecha` Desc  " ;
		
                                    if($table=="obd_ica_otros" or $table=="obd_medios_otros" or $table=="obd_reteica_otros" or $table=="obd_ica_otros_bimestral" or $table=="obd_ica_otros_trimestral" or $table=="obd_ica_otros_mensual" or $table=="obd_reteica_otros_bimestral"){	
					
                                        $querysel="SELECT dt.`Cliente`,
                                            (SELECT `nombre` FROM `cliente` WHERE `id`=dt.`Cliente`)as `Client-Nombre` ,t.`fecha`as Programado, 
                                            dt. `Estado`, 
                                            dt.`Fecha`, 
                                            dt.`Usuario` as IdEncargardo,
                                            (SELECT u.`usuario` FROM `usuario_web` u WHERE u.`id`=dt.`Usuario`)as Encargado,
                                            t.`Municipio`as IDMUNC,(SELECT m.`Municipio` FROM `tipo_municipio` m WHERE m.`id_tipo_municipio`=t.`Municipio`)as NOM_MUNIC
                                                        
                                            FROM `$table`  t, `detalle_trazabilidad`  dt Where ";
                                    }else{
                                        $querysel="SELECT dt.`Cliente`,
                                            (SELECT `nombre` FROM `cliente` WHERE `id`=dt.`Cliente`)as `Client-Nombre` ,t.`fecha`as Programado, 
                                            dt. `Estado`, 
                                            dt.`Fecha`, 
                                            dt.`Usuario` as IdEncargardo,
                                            (SELECT u.`usuario` FROM `usuario_web` u WHERE u.`id`=dt.`Usuario`)as Encargado
                                                        
                                            FROM `$table`  t, `detalle_trazabilidad`  dt Where ";
                                    
                                    
                                    }
                                            
                                                
                                    if($querybase==""){
                                        
                                    $queryp=$querysel." ".$table." t";
                                    
                                    }
                                                        
                                    if($querybase!=""){
                                    
                                    $queryp=$querysel.$querybase;
                                    
                                    }
                                    
                                        
                                    echo '<br>';
                                    //echo '<div><h2 class=card-title text-center><p><b>'.$queryp.'</b></p></h2></div>';
                                    echo Funciontabla::maketablesingle2($queryp,$nombre);
                                    
                        
                                } 
                              
                            }
                                
                            
@endphp
                        
