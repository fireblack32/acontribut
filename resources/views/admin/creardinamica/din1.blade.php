@extends("theme.$theme.layout")
@section('titulo')
    Crear Dinamica 
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
                <h3 class="card-title">Crear Obligación Dinamica</h3>
                
            </div>
            <form action="{{route('creardinamica2')}}" id="form-general" class="form-horizontal form--label-right" method="POST" autocomplete="off">
                @csrf  
                <div class="card-body">
                    @include('admin.creardinamica.formdin1')  
                    
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-3">
                            @include('includes.boton-form-guardar')
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection