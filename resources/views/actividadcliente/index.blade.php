@extends("theme.$theme.layout")
@section('titulo')
    Actividades Clientes
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
                    <h3 class="card-title">Actividades Economicas Clientes</h3>   
                </div>
                <form action="{{route('acticliente2')}}" id="form-general" class="form-horizontal form--label-right" method="POST" autocomplete="off">
                    @csrf
                    <div class="card-body">
                        
                        @include('actividadcliente.form')
                        
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-3">
                                @include('includes.boton-form-buscar')
                            </div>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection
