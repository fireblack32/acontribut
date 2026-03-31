@extends("theme.$theme.layout")
@section('titulo')
Sistema de Menus
@endsection
@section('titulopag')
Editar Sistema de Menus
@endsection
@section('contenido')
<div class="row">
    <div class="col-lg-12">
      @include("includes.form-error")
      @include('includes.mensajes')
        <div class="card-primary">
            <div class="card-header">
              <h3 class="card-title">Editar Superior</h3>
              <div class="card-tools">
                <a href="{{route('menu')}}" class="btn btn-outline-info btn-sm">
                    <i class="fa fa-fw fa-reply-all"></i> Volver al listado
                </a>
            </div>
            </div>
        </div>
        <div class="card-body">
        <form action="{{route('actualizar_menu', ['id' => $data->id])}}" id="form-general" method="POST" class="form-horizontal" autocomplete="off">
          @csrf @method("put")
                <div class="card-body">
                  @include("admin.menu.form2")
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        @include("includes.boton-form-editar")
                    </div> 
                </div>
                <!-- /.card-footer -->
              </form>
        </div>
    </div>
</div>  
@endsection