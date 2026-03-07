@extends("theme.$theme.layout")
@section('titulo')
CHECKLIST
@endsection

@section("scripts")
<script src="{{asset("Assets\lte\pages\scripts\admin\menu\index.js")}}" type="text/javascript"></script>
@endsection

@section('contenido')
<div class="row">
    <div class="col-lg-12">
        @include('includes.mensajes')
        
        <div class="card card-info text-center">
            <div class="card-header">
                <h3 class="card-title text-center">LISTA DE CHEQUEO</h3><br>
                <h3 class="card-title text-center">NIT O DOCUMENTO DEL CLIENTE: {{$idcliente}}</h3><br>
                <h3 class="card-title text-center">OBLIGACIÓN: {{$nomtabla}}</h3> 
            </div>
            <div class="card-body">
                @include("checklist.cabecero")
                <form action="" id="form-general" method="GET" class="form-horizontal" autocomplete="off">
                <div class="card-body table-responsive p-0">
                    <tbody>
                      
                        <table  class="table  table-hover"  id="tabla-data">
                            <thead>
                                <tr>
                                    <td colspan="6"><b>EL NOMBRE DEL CLIENTE ES:</b> {{$nomcliente}}</td>
                                </tr> 
                                <tr>
                                    <td colspan="6">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h3 class="card-title text-center"><b>PASOS PENDIENTES</b></h3><br>
                                            </div>
                                        </div>
                            
                                    </td>
                                </tr> 
                                <tr><td><a href="{{URL::to("checklist_pendiente/$id/$idobligaciones/$idcliente/$tabla")}}"><img src={{asset("Assets/images/pendiente.png")}} style='height: 32px; width: 32px; cursor:pointer' alt="pendiente"></a></td>
                                    <td><a href="{{URL::to("checklist_proceso/$id/$idobligaciones/$idcliente/$tabla")}}"><img src={{asset("Assets/images/en_proceso.png")}} style='height: 32px; width: 32px; cursor:pointer' alt="en proceso"></a></td>
                                    <td><a href="{{URL::to("checklist_noaplica/$id/$idobligaciones/$idcliente/$tabla")}}"><img src={{asset("Assets/images/no_aplica.png")}} style='height: 32px; width: 32px; cursor:pointer' alt="no aplica"></a></td>
                                    <td><a href="{{URL::to("checklist_finalizado/$id/$idobligaciones/$idcliente/$tabla")}}"><img src={{asset("Assets/images/finalizado.png")}} style='height: 32px; width: 32px; cursor:pointer' alt="finalizado"></a></td>
                                   
                                    
                                </tr> 
                                <tr>
                                    <td style='font-size:10px; width:70px; text-align:center' >Pendiente</td>
                                    <td style='font-size:10px; width:70px; text-align:center' >En Proceso</td>
                                    <td style='font-size:10px; width:70px; text-align:center' >No Aplica</td>
                                    <td style='font-size:10px; width:70px; text-align:center' >Finalizado</td>
                                </tr>
                                <tr>
                            @php
                            {{
                                    $usuario_id=session()->get('usuario_id');
				    $Estado='';
				    $now=date("Y-m-d H:i:s"); 
                                    if ($usuario_id!=''){

                                            $querych1='SELECT `idchecklist` FROM `checklist` WHERE `iditem_obligacion`="'.$idobligaciones.'" and `cliente_idcliente`="'.$idcliente.'" and `idprogramacion_obliga`="'.$id.'"';
                                            $database =Config::get('database.connections.'.Config::get('database.default'));
                                            $database_name=$database['database'];
                                            $database_host = $database['host'];
                                            $database_password =  $database['password'];
                                            $database_user =  $database['username'];
                                            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                            $result2=mysqli_query($conn,$querych1);
                                            $num_rows = mysqli_num_rows($result2);
                                            //echo $querych1;
                                            //con el codigo anterior validamos si los pasos de la obligacion ya existen en la tabla checklist
                                        if($num_rows<1){
                                            //si no existe entra en en el if y se crean.
                                            $querych2='SELECT `idpasos_checklist`, `idobligacion`, `descripcion`, `orden` FROM `pasos_checklist` WHERE `idobligacion`="'.$idobligaciones.'"';
                                            $database =Config::get('database.connections.'.Config::get('database.default'));
                                            $database_name=$database['database'];
                                            $database_host = $database['host'];
                                            $database_password =  $database['password'];
                                            $database_user =  $database['username'];
                                            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                            $resultpasos=mysqli_query($conn,$querych2);

                                            while($row=mysqli_fetch_array($resultpasos)){
                                                $idpasos_checklist=$row["idpasos_checklist"];
			                                    $idobligacion=$row["idobligacion"];
                                                $descripcion=$row["descripcion"];
                                               
                                                $querych3="REPLACE INTO `checklist` (`iditem_obligacion`, `idpasos_checklist`, `descripcion`, 
                                                    `cliente_idcliente`, `idusuario_web`, `fecha_rev`, `Estado`, `idprogramacion_obliga`,`Estado_Fin`,`FechaEstadoFin`)
                                                    VALUES ('$idobligacion','$idpasos_checklist','$descripcion','$idcliente','$usuario_id','$now','0','$id','0','$now')";
                                                $database =Config::get('database.connections.'.Config::get('database.default'));
                                                $database_name=$database['database'];
                                                $database_host = $database['host'];
                                                $database_password =  $database['password'];
                                                $database_user =  $database['username'];
                                                $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                                $resultadosch3=mysqli_query($conn,$querych3);    
			                                   // echo $querych3."<br>";
                                                
                                            }
                                        }

                                        $querych4="SELECT  p.`iditem_obligacion`as IDOB, 
                                        (SELECT o.`nombre` FROM `obligaciones` o WHERE o.`idobligaciones` = p.`iditem_obligacion`)as Nombre, 
                                        p.`descripcion`as Descripcion , c.`orden` as Orden,p.`Estado`,
                                        (SELECT t.`Descripcion` FROM `item_checklist_estado` t WHERE t.`Estado`=p.`Estado`)as NomEstado
                                        ,p.`fecha_rev`as Fecha, p.`idchecklist` as idch FROM `pasos_checklist` c, `checklist` p 
                                        where p.`iditem_obligacion`=$idobligaciones and p.`cliente_idcliente`=$idcliente and p.`idprogramacion_obliga`=$id
                                        and p.`idpasos_checklist`=c.`idpasos_checklist` and `Estado`<> 2 and `Estado`<> 3 order by c.`orden`";
                                        //echo $querych3."<br>";
                                        echo Funciontabla::checklisttable($querych4,'checklist_procesounico','checklist_noaplicaunico','checklist_finalizadounico',$tabla,$idcliente,$id);
                                    }
                            }}
                            @endphp
                                </tr>
                                <tr>
                                    <td colspan="6">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h3 class="card-title text-center"><b>PASOS REALIZADOS</b></h3><br>
                                            </div>
                                        </div>
                            
                                    </td>
                                </tr> 
                                <tr>
                                    @php
                                    {{
                                        $usuario_id=session()->get('usuario_id');
                                    if ($usuario_id!=''){

                                        $queryrealizadas="SELECT distinct  p.`iditem_obligacion`as IDOB, 
                                        (SELECT o.`nombre` FROM `obligaciones` o WHERE o.`idobligaciones` = p.`iditem_obligacion`)as Nombre, 
                                        p.`descripcion`as Descripcion ,p.`Estado`,
                                        (SELECT distinct t.`Descripcion` FROM `item_checklist_estado` t WHERE t.`Estado`=p.`Estado`)as NomEstado
                                        ,p.`fecha_rev`as Fecha, p.`idchecklist` as idch FROM `pasos_checklist` c, `checklist` p 
                                        where p.`iditem_obligacion`=$idobligaciones and p.`cliente_idcliente`=$idcliente and p.`idprogramacion_obliga`=$id
                                        and p.`idpasos_checklist`=c.`idpasos_checklist` and p.`Estado`>= 2 and  p.`Estado`< 4";
                                        //echo $queryrealizadas."<br>";
                                        echo Funciontabla::maketablereturn($queryrealizadas,'checklist_return',$tabla,$idcliente,$id);

                                    }

                                    }}
                            @endphp
                                </tr>
                                <tr>
                                    <td colspan="6">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h3 class="card-title text-center"><b>DATOS ADICIONALES</b></h3><br>
                                            </div>
                                        </div>
                            
                                    </td>
                                </tr> 
                                <tr>
                                    @php
                                    {{
                                        $Descripcion="";
                                        $usuario_id=session()->get('usuario_id');
                                    if ($usuario_id!=''){
                                        $queryest1="SELECT `tabla_obligacion` FROM `obligaciones` WHERE `idobligaciones`='$idobligaciones'";
                                        $database =Config::get('database.connections.'.Config::get('database.default'));
                                        $database_name=$database['database'];
                                        $database_host = $database['host'];
                                        $database_password =  $database['password'];
                                        $database_user =  $database['username'];
                                        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                        $resultadosest1=mysqli_query($conn,$queryest1);
                                                
                                        while ($row1 = mysqli_fetch_array($resultadosest1)){
                                                $tabla_obligacion=$row1["tabla_obligacion"];

                                         } 
                                        echo "Los datos adicionales son <br>";
                                        $querydescripcion="SELECT `Descripcion` FROM `presentacion_obligaciones` WHERE `id_obligacion`='$idobligaciones'";
                                        $database =Config::get('database.connections.'.Config::get('database.default'));
                                        $database_name=$database['database'];
                                        $database_host = $database['host'];
                                        $database_password =  $database['password'];
                                        $database_user =  $database['username'];
                                        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                        $resultadosdescripcion=mysqli_query($conn,$querydescripcion);
                                        
                                        while ($row = mysqli_fetch_array($resultadosdescripcion)){
                                            $Descripcion=$row["Descripcion"];
                                        }
                                        if ($Descripcion==''){
                                            $Descripcion="SELECT `fecha` as Fecha FROM $tabla_obligacion WHERE `id`=";
                                        }
                                        $querydescripcion=$Descripcion.$id;
                                        //echo $querydescripcion.$id."<br>";

                                        echo Funciontabla::maketablesingle($querydescripcion);

                                    }

                                    }}
                            @endphp
                                </tr>
                                <tr>
                                    <td colspan="6">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h3 class="card-title text-center"><b>ESTADO OBLICACIÓN</b></h3><br>
                                            </div>
                                        </div>
                            
                                    </td>
                                </tr> 
                </form> 
                                <tr>
                                    @php
                                    
                                    {{
                                        $Descripcion="";
					$usuario_id=session()->get('usuario_id');
					$est='';
                                    if ($usuario_id!=''){
                                            $querych2='SELECT `perfil_idperfil` FROM `usuario_web` WHERE `id`="'.$usuario_id.'"';
                                            $database =Config::get('database.connections.'.Config::get('database.default'));
                                            $database_name=$database['database'];
                                            $database_host = $database['host'];
                                            $database_password =  $database['password'];
                                            $database_user =  $database['username'];
                                            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                            $resultpasos=mysqli_query($conn,$querych2);

                                            while($row=mysqli_fetch_array($resultpasos)){
                                                $perfil_idperfil=$row["perfil_idperfil"];
                                                //echo $perfil_idperfil."<br>";
                                            }


                                            $querychpr2='SELECT `idchecklist`, p.`Estado`,p.`FechaEstadoFin`,`Estado_Fin` FROM `pasos_checklist` c, `checklist` p 
                                                        where p.`iditem_obligacion`="'.$idobligaciones.'" and p.`cliente_idcliente`="'.$idcliente.'" and p.`idprogramacion_obliga`="'.$id.'"
                                                        and p.`idpasos_checklist`=c.`idpasos_checklist`';
                                            $database =Config::get('database.connections.'.Config::get('database.default'));
                                            $database_name=$database['database'];
                                            $database_host = $database['host'];
                                            $database_password =  $database['password'];
                                            $database_user =  $database['username'];
                                            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                            $resultpasos=mysqli_query($conn,$querychpr2);
                                            $est='';
                                            while($row=mysqli_fetch_array($resultpasos)){
                                                $Estado=$row["Estado"];
                                                $Estado_Fin=$row["Estado_Fin"];
                                                $fecha_estado_fin = $row["FechaEstadoFin"];
                                                if($Estado=='0'){
                                                    $est=0;
                                                }
                                                    //echo $i
                                                if($Estado!='0' and $Estado!='2' and $Estado!='3'){
                                                    $est=1;
                                                }				 
                                            }
                                            if($est=='0'){
                                                $Estado_Fin="Pendiente";
                                            
                                            }
                                            if($est=='1'){
                                                $Estado_Fin="En proceso";
                                            
                                            }

                                    }
                                                $querych2='SELECT  p.`Estado` FROM `detalle_trazabilidad` p 
                                                        where p.`Tipo_obligacion`="'.$idobligaciones.'" and p.`Cliente`="'.$idcliente.'" and p.`idObligacion`="'.$id.'" ORDER by `Fecha` DESC LIMIT 1';
                                                
                                                //echo $querych2."<br>";
                                                $database =Config::get('database.connections.'.Config::get('database.default'));
                                                $database_name=$database['database'];
                                                $database_host = $database['host'];
                                                $database_password =  $database['password'];
                                                $database_user =  $database['username'];
                                                $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                                $resultpasos=mysqli_query($conn,$querych2);
                                                
                                                while($row=mysqli_fetch_array($resultpasos)){
                                                    $Estado=$row["Estado"];
                                                }
                                    
                                    }}
                                    @endphp
                                    @if ($est!='0'and $est!='1')
                                            <form action="{{route("checklist_estadofinal")}}" method="POST">
                                        @csrf
                                            <label for="nombre">ESTADO DE LA OBLIGACIÓN </label><br>
                                            <label for="terms">Finalizado sin Revisición</label>
                                            @if ($Estado=='Finalizada sin Revision')
                                            <input type="radio" name="estado" value="finsinrev" checked><br>   
                                            @else
                                            <input type="radio" name="estado" value="finsinrev"><br>
                                            @endif
                                        @if ($est!='0'and $est!='1' and $perfil_idperfil<'4')

                                            <label for="terms">Segunda Revisión</label>
                                            @if ($Estado=='Segunda Revision')
                                            <input type="radio" name="estado" value="segundarev" checked><br>    
                                            @else
                                            <input type="radio" name="estado" value="segundarev"><br>
                                            @endif
                                            <label for="terms">Revisión SGS</label>
                                            @if ($Estado=='Revision SGS')
                                            <input type="radio" name="estado" value="revsgs" checked><br>   
                                            @else
                                            <input type="radio" name="estado" value="revsgs"><br>
                                            @endif
                                            <label for="terms">Finalizado con Revisión</label>
                                            @if ($Estado=='Finalizada con Revision')
                                            <input type="radio" name="estado" value="finrev" checked><br>   
                                            @else
                                            <input type="radio" name="estado" value="finrev"><br>
                                            @endif
                                            <label for="terms">Entregado al Cliente</label>
                                            @if ($Estado=='Entregado al Cliente')
                                            <input type="radio" name="estado" value="entregadocli" checked><br>   
                                            @else
                                            <input type="radio" name="estado" value="entregadocli"><br>
					    @endif
					    @endif
					    @endif
                                            <input id="prodId" name="id" type="hidden" value="{{$id}}">
                                            <input id="prodId" name="tabla" type="hidden" value="{{$tabla}}">
                                            <input id="prodId" name="cliente" type="hidden" value="{{$idcliente}}">
                                            <input id="prodId" name="iditemobligacion" type="hidden" value="{{$idobligaciones}}">
					  
					    
                                            <br><button type="submit" class="btn btn-success">Guardar</button>
                                            </form>
                                        
                                   
                                </tr>
                                @php
                                {{
                                        
                                                //Fin de la modificacion 
                                                $queryestado2="SELECT dt.`Cliente`,(SELECT `nombre` FROM `cliente` WHERE `id`=dt.`Cliente` LIMIT 1)as `Client-Nombre` ,dt.`Fecha`, dt. `Estado`, dt.`Usuario` as IdEncargardo,(SELECT u.`usuario` FROM `usuario_web` u WHERE u.`id`=dt.`Usuario` LIMIT 1)as Encargado 

                                                FROM `detalle_trazabilidad` dt 

                                                WHERE  dt.`idObligacion`='$id'  and  dt.`Tipo_obligacion`='$idobligaciones' AND dt.`Cliente`='$idcliente' order by dt.`Fecha` Desc limit 5 ";
                                               // echo $querych2." estado".$est;
                                                echo Funciontabla::maketablesingle($queryestado2);
                                                echo "<br>*Ultimos 5 Estados Asociados a un Usuario<br>";


                                }}
                            @endphp
                                </tr>
                    
                            </thead>
                        </table>  
                            
                                
                    </tbody>
                        <!-- /.card-body -->
                         
                </div>
                        <!-- /.card-footer -->
                   
            </div>
        </div>
    </div>
</div>
@endsection
