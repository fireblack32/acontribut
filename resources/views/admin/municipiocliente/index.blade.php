@extends("theme.$theme.layout")
@section('titulo')
    Municipio Cliente
@endsection

@section("scripts")
<script src="{{asset("assets/pages/scripts/admin/crear.js")}}" type="text/javascript"></script>
@endsection

@section('contenido')
<div class="row">
    <div class="col-lg-12">
        @include('includes.form-error')
        @include('includes.mensajes')
        @include('includes.mensajes2')
        <div class="card-primary">
            <div class="card-header">
                <h3 class="card-title">Asignar Municipio al cliente</h3>
                
            </div>
            <form action="{{route('guardar_municipio')}}" id="form-general" class="form-horizontal form--label-right" method="POST" autocomplete="off">
                @csrf
                <div class="card-body">
                    @include('admin.municipiocliente.form')  
                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-3">
                            @include('includes.boton-form-crear')
                        </div>
                    </div>
                </div>
            </form>
            <div class="card-body table-responsive p-0">
                <tbody>
                    <tr>
                        <td colspan="6">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="card-title text-center"><b>CLIENTES VS MUNICIPIOS</b></h3><br>
                                </div>
                            </div>
                
                        </td>
                    </tr> 
                    <tr>
                        @php
                            {{
                                
                                        //Fin de la modificacion 
                                        $queryestado2="SELECT  cm.`idcliente`,(SELECT c.`nombre` FROM `cliente` c WHERE c.`id`=cm.`idcliente`) AS NomCliente ,cm.`idmunicipio`,(SELECT CONCAT(m.`Municipio`, m.`Departamento`) FROM `tipo_municipio` m WHERE m.`id_tipo_municipio`=cm.`idmunicipio`)as Municipio,cm.`id` FROM `cliente_has_municipio` cm ";
                                        //echo $queryestado2;
                                        echo Funciontabla::maketableborrar($queryestado2,'borrar_municipio','id');

                            }}
                        @endphp
                    </tr>
                </tbody>
            </div>
        </div>
    </div>
</div>
@endsection