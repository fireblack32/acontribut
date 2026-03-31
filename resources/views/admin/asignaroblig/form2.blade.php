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
                <h3 class="card-title text-center">LISTADO DE OBLIGACIONES</h3><br>
                <h3 class="card-title text-center">NIT O DOCUMENTO DEL CLIENTE: {{$cliente}}</h3><br>
                @php 
                {{
                    $nombre="";
                    $check='';
                    $usuario_id=session()->get('usuario_id');
                    if ($usuario_id!=''){
                    
                    $queryb="SELECT `nombre` FROM `cliente` WHERE `id`='$cliente'";
                    //echo $queryb; 
                    $database =Config::get('database.connections.'.Config::get('database.default'));
                    $database_name=$database['database'];
                    $database_host = $database['host'];
                    $database_password =  $database['password'];
                    $database_user =  $database['username'];
                    $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                    $resultnombre=mysqli_query($conn,$queryb);
                            
                    while($row=mysqli_fetch_array($resultnombre)){
                            $nombre=$row["nombre"];
                        }
                    }
                    
                }}
                @endphp
                <h3 class="card-title text-center">NOMBRE: {{$nombre}}</h3> 
            </div>
            <div class="card-body">
                <div class="card-body table-responsive p-0">
                    <tbody>
                    <form action="{{route('guardar_obligacionind')}}" id="form-general" class="form-horizontal form--label-right" method="POST" autocomplete="off">
                        @csrf
                        <table  class="table  table-hover"  id="tabla-data">
                            <thead>
                            <tr>
                                @php
                                {{
                                echo "<input type='hidden' name='cliente' value='".$cliente."'><td>";
                                if ($usuario_id!=''){
                                    $queryvac="SELECT `idusuario_web` FROM `cliente` WHERE `id`='$cliente'";
                                    $database =Config::get('database.connections.'.Config::get('database.default'));
                                    $database_name=$database['database'];
                                    $database_host = $database['host'];
                                    $database_password =  $database['password'];
                                    $database_user =  $database['username'];
                                    $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                    $resultusuario=mysqli_query($conn,$queryvac);
                                            
                                    while($rowvac=mysqli_fetch_array($resultusuario)){
                                        $usuarioasigvac=$rowvac["idusuario_web"];
                                    }
  	
                                    $query2="SELECT `idobligaciones`, `nombre`, tabla_obligacion  FROM `obligaciones` ORDER BY `nombre`";
                                    $database =Config::get('database.connections.'.Config::get('database.default'));
                                    $database_name=$database['database'];
                                    $database_host = $database['host'];
                                    $database_password =  $database['password'];
                                    $database_user =  $database['username'];
                                    $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                    $resultsoblig=mysqli_query($conn,$query2);
                                            
                                    while($row=mysqli_fetch_array($resultsoblig)){
                                    $idobligaciones=$row["idobligaciones"];
                                    $nombre=$row["nombre"];
                                    
                                    $query3="SELECT `idusuario_web_encargado` FROM `cliente_has_obligaciones` WHERE `cliente_idcliente`='$cliente' and `obligaciones_idobligaciones`=$idobligaciones ";
                                    $database =Config::get('database.connections.'.Config::get('database.default'));
                                    $database_name=$database['database'];
                                    $database_host = $database['host'];
                                    $database_password =  $database['password'];
                                    $database_user =  $database['username'];
                                    $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                    $resultados3=mysqli_query($conn,$query3);
                                    $resultados31 = mysqli_num_rows($resultados3);
                                    if($resultados31 > 0){
                                        $row2 = mysqli_fetch_array($resultados3);
                                        $usuarioasig=$row2["idusuario_web_encargado"];
                                        $check="checked=\"checked\"";
                                        $update = 1;
                                    }else{			
                                        $usuarioasig = $usuarioasigvac;
                                        $update = 0;
                                    }
                                    
                                    
                                    echo "<tr><td align=left style='width:5px'><input name=ob".$idobligaciones." type=checkbox value=".$idobligaciones." ".$check." ></td><td align=left>".utf8_encode($nombre)."</td>";	
                                    echo "<td align=right >&nbsp;Usuario Encargado: </td>";
                                    echo "<input type='hidden' name='update".$idobligaciones."' value='".$update."'><td>";
                                    
                                    echo "<select name='usuarioren".$idobligaciones."'>"; 
                                        $query4="SELECT * FROM `usuario_web` WHERE estado=1 ORDER BY usuario"; 
                                        $database =Config::get('database.connections.'.Config::get('database.default'));
                                        $database_name=$database['database'];
                                        $database_host = $database['host'];
                                        $database_password =  $database['password'];
                                        $database_user =  $database['username'];
                                        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                        $resultsselect=mysqli_query($conn,$query4);
                                        while ($row3 = mysqli_fetch_array($resultsselect)){
                                                if($row3["id"]==$usuarioasig){
                                                echo "<option value={$row3["id"]} selected=selected >{$row3["usuario"]}</option>";
                                                }else{
                                                echo "<option value={$row3["id"]}>{$row3["usuario"]}</option>";
                                                }
                                            }
                                    echo "</select></td></tr>";
                                  
                                        $check="";
                                        }
                                   
                                    }
                                }}
                            
                            @endphp
                            </tr>
                            
                            <tr><td style='width:5px'>
                                    <div class="card-footer">
                                        <div class="row">
                                            
                                                @include('includes.boton-form-editar')
                                            
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </thead>
                        </table>  

                    </form>                               
                    </tbody>
                    
                        <!-- /.card-body -->
                         
               
                        <!-- /.card-footer -->
                </div>  
            </div>
        </div>
    </div>
</div>
@endsection