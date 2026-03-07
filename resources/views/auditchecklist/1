@extends("theme.$theme.layout")
@section('titulo')
Auditoria Checklist
@endsection

@section("scripts")
<script src="{{asset("Assets\lte\pages\scripts\admin\menu\index.js")}}" type="text/javascript"></script>
@endsection

@section('contenido')
<div class="row">
    <div class="col-lg-12">
        @include('includes.mensajes')
        @php
        {{
             $query="SELECT `nombre`, `apellidos` FROM `usuario_web` WHERE `id`=$usuario";
             $database =Config::get('database.connections.'.Config::get('database.default'));
             $database_name=$database['database'];
             $database_host = $database['host'];
             $database_password =  $database['password'];
             $database_user =  $database['username'];
             $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
             $result2=mysqli_query($conn,$query);
                            
             while($row=mysqli_fetch_array($result2)){
                $nombre=$row["nombre"];
                $apellidos=$row["apellidos"];
                $auditado=$nombre." ".$apellidos;
                }

        }}
    @endphp
    
        
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Pendientes de un usuario</h3>
                
                
            </div>
            <div class="card-body">
                
                    @csrf
                 
                 <div class="card-footer">
                    <div class="col-lg-3"></div>
                    
                </div>
                 <div class="card-body table-responsive p-0">
                    <tbody>
                      <div class="card-body table-responsive p-0">
                        <table  class="table table-striped table-bordered table-hover"  id="tabla-data">
                            <thead>
                                <tr>
                                    @php
                                    
                                    {{
                                          
                                        $usuario_id=session()->get('usuario_id');
                                        if ($usuario_id!=''){
                                            $query='SELECT idobligaciones, nombre, tabla_obligacion FROM obligaciones ORDER BY nombre';
                                            $database =Config::get('database.connections.'.Config::get('database.default'));
                                            $database_name=$database['database'];
                                            $database_host = $database['host'];
                                            $database_password =  $database['password'];
                                            $database_user =  $database['username'];
                                            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                            $result2=mysqli_query($conn,$query);
                                            echo "<br><div><h4 class=fa fa-fw fa-plus-circle><p><b>$auditado</b></p></h4></div>";
                                            while($row=mysqli_fetch_array($result2)){
                                                $table=$row["tabla_obligacion"];
                                                $nombre=$row["nombre"];
						
						if($table=='obd_ica_otros' or $table=='obd_medios_otros' or $table=='obd_reteica_otros' or $table=='obd_ica_otros_bimestral' or $table=='obd_ica_otros_trimestral' or $table=='obd_ica_otros_mensual' or $table=='obd_reteica_otros_bimestral'){
                                                    $querytab='SELECT t.`fecha`,t.`cliente_idcliente`,(SELECT `nombre` FROM `nombre_estado_pendiente` WHERE `idnombre_estado_pendiente`=t.`Estado`)as Estado,(SELECT c.`nombre` FROM `cliente` c WHERE c.`id`=t.`cliente_idcliente`)as Nombre,(SELECT tpm.`Municipio` FROM `tipo_municipio` tpm  WHERE tpm.`id_tipo_municipio`=t.`Municipio`)as Municipio,t.id as ID FROM  '.$table.' t where  t.`fecha`>="'.$fecha_ini.'" and t.`fecha`<="'.$fecha_fin.'" and t.`idusuario_web`='.$usuario.' order by t.`fecha`';
                                                }
                                                else {
                                                    $querytab='SELECT t.`fecha`,t.`cliente_idcliente`,(SELECT `nombre` FROM `nombre_estado_pendiente` WHERE `idnombre_estado_pendiente`=t.`Estado`)as Estado,(SELECT c.`nombre` FROM `cliente` c WHERE c.`id`=t.`cliente_idcliente`)as Nombre,t.id as ID FROM  '.$table.' t where  t.`fecha`>="'.$fecha_ini.'" and t.`fecha`<="'.$fecha_fin.'" and t.`idusuario_web`='.$usuario.' order by t.`fecha`';
                                                }
						//echo $querytab.'<br>';
                                                //echo '<div><h2 class="card-title text-center"><p><b>'.$querytab.'</b></p></h2></div>';
                                                
                                                echo Funciontabla::maketablebuscar($querytab,'checklist',$table,$nombre);
                                                }
                                            
                                                echo '</tr>';
                                                                       
                                            }
                                           
  
                                            
                                    }}
                                @endphp
                                </tr> 
                            </thead>
                        </table>  
                      </div> 
                               
                    </tbody>
                        <!-- /.card-body -->
                         
                    </div>
                        <!-- /.card-footer -->
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection
