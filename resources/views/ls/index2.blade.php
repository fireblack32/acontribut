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
            
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Lista de Accionistas</h3>
                    <div class="card-tools">
                        
                        <a href="{{URL::to("listaaccionistas_actualizar/$cliente")}}" class="btn-outline-secondary btn-sm">
                            <i class="fa fa-fw fa-plus-circle"></i> Adicionar accionistas al cliente
                        </a>
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
                                                    $query='SELECT r.`cliente_idcliente` as Cliente,(SELECT i.`nombre` FROM `cliente` i WHERE i.`id`=r.`cliente_idcliente`)as Nombre,`Porc_Parti`as Participacion,`documento`,concat(r.`nombres`," ",r.`apellidos`)as BENEFICIARIOS_FINALES,`Pais`,`idrepresentante_cliente`as Id FROM `representante_cliente` r WHERE `cliente_idcliente`='.$cliente.'';
                                                    
                                                    $database =Config::get('database.connections.'.Config::get('database.default'));
                                                    $database_name=$database['database'];
                                                    $database_host = $database['host'];
                                                    $database_password =  $database['password'];
                                                    $database_user =  $database['username'];
                                                    $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                                    $result2=mysqli_query($conn,$query);
                                    
                                                    
                                                    echo Funciontabla::maketableborrar($query,'listaaccionistas_borrar');
                                                    }
                                                
                                                    echo '</tr>';
                                                                           
                                                
                                            }}
                                    @endphp
                                    </tr> 
                                </thead>
                            </table>  
                          </div> 
                                   
                        </tbody>
                            <!-- /.card-body -->
                             
                    </div>
                
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection
