@extends("theme.$theme.layout")
@section('titulo')
Usuarios
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
                <h3 class="card-title">Usuarios Web</h3>
                <div class="card-tools">
                    <a href="{{route('crear_usuario')}}" class="btn btn-outline-secondary btn-sm">
                        <i class="fa fa-fw fa-plus-circle"></i> Nuevo registro
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table  class="table table-striped table-bordered table-hover"  id="tabla-data">
                    <thead>
                        <tr>
                            <tr>
                                <th class="width20">ID</th>
                                <th>Documento</th>
                                <th>usuario</th>
                                <th>Email</th>
                                <th>Fech Venc</th>
                                <th class="width80"></th>
                            </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                        <tr>
                            <td>{{$data->id}}</td>
                            <td>{{$data->documento}}</td>
                            <td>{{$data->usuario}}</td>
                            <td>{{$data->email}}</td>
                            <td>{{$data->fecha_ven}}</td>
                            <td>
                                <a href="{{url("admin/user/$data->id/editar")}}" class="btn-accion-tabla tooltipsC" title="Editar este registro">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{route('eliminar_usuario', ['id' => $data->id])}}"  class="d-inline form-eliminar" method="POST">
                                    @csrf @method("delete")
                                    <button type="submit" class="btn-accion-tabla eliminar tooltipsC" title="Eliminar este registro">
                                        <i class="fa fa-times-circle text-danger"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

