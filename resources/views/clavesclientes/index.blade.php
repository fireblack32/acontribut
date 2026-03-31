@extends("theme.$theme.layout")
@section('titulo')
    Claves Clientes
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
                    <h3 class="card-title">Claves Clientes</h3>   
                </div>
                <form action="{{route('clavesclientes2')}}" id="form-general" class="form-horizontal form--label-right" method="POST" autocomplete="off">
                    @csrf
                    <div class="card-body">
                        @include('clavesclientes.form')
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