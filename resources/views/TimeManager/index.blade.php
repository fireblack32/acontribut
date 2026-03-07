@extends("theme.$theme.layout")
@section('titulo')
Time Manager
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
                <h3 class="card-title">Registro de Tiempos</h3>
                <div class="card-tools">
                    <a href="{{route('crear_timemanager')}}" class="btn-outline-secondary btn-sm">
                        <i class="fa fa-fw fa-plus-circle"></i> Crear Nuevo registro
                    </a>
                </div>
                <div class="card-tools">
                    <a href="{{route('mostrar_timemanager')}}" class="btn-outline-secondary btn-sm">
                        <i class="fa fa-fw fa-plus-circle"></i> Consultar registro en una fecha
                    </a>
                </div>
            </div>
            <div class="info">
                <a href="#" class="d-block">Usuario: {{session()->get('usuario')?? 'Invitado'}}</a>
            </div>
            <div class="card-body table-responsive p-0">
                <table  class="table table-striped table-bordered table-hover"  id="tabla-data">
                    <thead>
                        <tr>
                            <tr>
                                <th class="width20">Auditor</th>
                                <th>AUD</th>
                                <th>SUP</th>
                                <th>PLN</th>
                                <th>SGS</th>
                                <th>TOTAL</th>
                              
                            </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                        <tr>
                            <td>{{$data->Auditor}}</td>
                            <td>{{$data->AUD}}</td>
                            <td>{{$data->SUP}}</td>
                            <td>{{$data->PLN}}</td>
                            <td>{{$data->SGC}}</td>
                            <td>{{$data->TOTAL}}</td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
