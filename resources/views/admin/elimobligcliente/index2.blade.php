@extends("theme.$theme.layout")
@section('titulo')
    Consulta Reporte 
@endsection

@section("scripts")
<script src="{{asset("assets/pages/scripts/admin/crear.js")}}" type="text/javascript"></script>
@endsection

@section('contenido')
<div class="row">
    <div class="col-lg-12">
        @include('includes.form-error')
        @include('includes.mensajes')
        <div class="card-primary">
            <div class="card-header">
                <h3 class="card-title">Eliminar Obligación de un cliente</h3>
                <div class="card-tools">
                    <a href="{{route('elimobcliente')}}" class="btn btn-outline-info btn-sm">
                        <i class="fa fa-fw fa-reply-all"></i> Volver
                    </a>
                </div>
            </div>
            <br>
            
            <div class="card-body">
                <table  class="table table-striped table-bordered table-hover"  id="tabla-data">
                    <thead>
                        <tr>
                            @php
                            
                            {{
                            
                                        $querypre='SELECT DISTINCT 
                                        (select `nombre` from `obligaciones` where `idobligaciones`=`obligaciones_idobligaciones`)as Nombre,`obligaciones_idobligaciones`as Obligaciones, `cliente_idcliente` as Cliente, `id` 
                                        FROM `cliente_has_obligaciones` WHERE `cliente_idcliente`='.$cliente.' order by Obligaciones';

                                
                                                                            
                                          echo '<tr>';
                                         //  echo '<div><h2 class=card-title text-center><p><b>tabla:'.$table.' el query es: '.$queryp.'</b></p></h2></div>';
                                          echo Funciontabla::maketableborrar2($querypre,'borrar_obligacion','tabla');
						                  echo '<tr>';
					
                        

                        }}
                        @endphp
                        </tr> 
                    </thead>
                </table>  


            </div>
            
        </div>
    </div>
</div>
@endsection
