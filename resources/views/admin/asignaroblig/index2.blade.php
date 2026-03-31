@extends("theme.$theme.layout")
@section('titulo')
    Asignar Obligaciones
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
                <h3 class="card-title">Asignar Obligaciones individuales</h3>
                
            </div>
            
                <div class="card-body">
                    @include('admin.asignaroblig.form2')  
                    
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection