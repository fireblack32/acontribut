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
                <h3 class="card-title">Bienvenidos</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table  class="table table-striped table-bordered table-hover"  id="tabla-data">
                    
                </table>
            </div>
            <div class="card-body table-responsive p-0">
                <table  class="table table-striped table-bordered table-hover"  id="tabla-data">
                    <thead>
                        <tr>
                           
                        </tr>
                    </thead>
                            <tbody>
                            </tbody>
                </table>
            </div>
                
        </div>
    </div>
</div>
@endsection