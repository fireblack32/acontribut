@extends("theme.$theme.layout")
@section('titulo')
Mis Pendientes
@endsection

@section("scripts")
<script src="{{asset("Assets\lte\pages\scripts\admin\menu\index.js")}}" type="text/javascript"></script>
@endsection

@section('contenido')
<div class="row">
    <div class="col-lg-12">
        @include('includes.mensajes')
        
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Mis Pendientes</h3>
                <div class="card-tools">
                    <a href="{{route('pendientes_todos')}}" class="btn-outline-secondary btn-sm">
                        <i class="fa fa-fw fa-plus-circle"></i> Buscar todos mis pendientes
                    </a>
                </div>
                
            </div>
            <div class="card-body">
                <form action="{{route('mispendientes_fechas')}}" id="form-general" method="POST" class="form-horizontal" autocomplete="off">
                    @csrf
                 <div class="card-body">
                          @include("mispendientes.form")
                 </div>
                 <div class="card-footer">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        @include("includes.boton-form-buscar")
                    </div> 
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
                                            //$result=DB::select($query);//realiza un query
                                            //$result = json_decode(json_encode($result), true);
                                            $database =Config::get('database.connections.'.Config::get('database.default'));
                                            $database_name=$database['database'];
                                            $database_host = $database['host'];
                                            $database_password =  $database['password'];
                                            $database_user =  $database['username'];
                                            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                            $result2=mysqli_query($conn,$query);
                                
                                            while($row=mysqli_fetch_array($result2)){
                                                $table=$row["tabla_obligacion"];
                                                $nombre=$row["nombre"];
                                                $querytab='SELECT t.`fecha`,t.`cliente_idcliente`,(SELECT `nombre` FROM `nombre_estado_pendiente` WHERE `idnombre_estado_pendiente`=t.`Estado`)as Estado,(SELECT c.`nombre` FROM `cliente` c WHERE c.`id`=t.`cliente_idcliente`)as Nombre,t.id as ID FROM  '.$table.' t where  t.`idusuario_web`='.$usuario_id.' and t.`Estado`<>7 order by t.`fecha`';
                                                //echo '<div><h2 class="card-title text-center"><p><b>'.$querytab.'</b></p></h2></div>';
                                                echo '<tr>';
                                                
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
