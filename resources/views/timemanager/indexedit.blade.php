@extends("theme.$theme.layout")
@section('titulo')
Editar Timemanager
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
                <h3 class="card-title">Editar Timemanager</h3>
                <div class="card-tools">
            </div>
                
            </div>
            <div class="card-body">
                <form action="{{route('buscar_timemanager')}}" id="form-general" method="POST" class="form-horizontal" autocomplete="off">
                    @csrf
                 <div class="card-body">
                          @include("timemanager.formedit")
                 </div>
                 <div class="card-footer">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        @include("includes.boton-form-buscar")
                    </div> 
                </div>
                <div class="card-body table-responsive p-0">
                    <tbody>
                      <div class="card-body table-responsive p-0">
                        <table  class="table table-striped table-bordered table-hover"  id="tabla-data">
                            <thead>
                               
                            </thead>
                        </table>  
                      </div> 
                               
                    </tbody>
                        <!-- /.card-body -->
                         
                </div>
                        <!-- /.card-footer -->
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection
