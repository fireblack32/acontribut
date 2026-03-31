@extends("theme.$theme.layout")
@section('titulo')
Sistema de Permisos
@endsection
@section('titulopag')
Crear Permisos
@endsection
@section("scripts")
<script src="{{asset("Assets/pages/scripts/admin/crear.js")}}" type="text/javascript"></script>
@endsection

@section('contenido')
<div class="row">
    <div class="col-lg-12">
      @include("includes.form-error")
      @include('includes.mensajes')
        <div class="card-primary">
            <div class="card-header">
              <h3 class="card-title">Crear Permisos</h3>
              <div class="card-tools">
                <a href="{{route('permiso')}}" class="btn btn-outline-info btn-sm">
                    <i class="fa fa-fw fa-reply-all"></i> Volver al listado
                </a>
            </div>
            </div>
        </div>
        <div class="card-body">
        <form action="{{route('guardar_permiso')}}" id="form-general" method="POST" class="form-horizontal" autocomplete="off">
          @csrf
                <div class="card-body">
                  @include("admin.permiso.form")
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        @include("includes.boton-form-crear")
                    </div> 
                </div>
                <!-- /.card-footer -->
              </form>
        </div>
    </div>
</div>  
@endsection