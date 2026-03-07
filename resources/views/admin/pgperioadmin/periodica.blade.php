@extends("theme.$theme.layout")
@section('titulo')
    Obligción periodica
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
                <h3 class="card-title">Programar Obligación Periodica</h3>
                
            </div>
            <form action="{{route('guardar_periodica')}}" id="form-general" class="form-horizontal form--label-right" method="POST" autocomplete="off">
                @csrf  
                <div class="card-body">
                    @if ($id=='27')
                        
                    @include('admin/pgperioadmin/formperiodicac1')
                    
                    @endif 
                                    
                    @if ($id=='28')
                        
                    @include('admin/pgperioadmin/formperiodicac2')
                    
                    @endif  

                    @if ($id=='29')
                        
                    @include('admin/pgperioadmin/formperiodicac3')
                    
                    @endif  

                    @if ($id=='30')
                        
                    @include('admin/pgperioadmin/formperiodicac4')
                    
                    @endif 

                    @if ($id=='31')
                        
                    @include('admin/pgperioadmin/formperiodicac5')
                    
                    @endif 

                    @if ($id=='32')
                        
                    @include('admin/pgperioadmin/formperiodicac1')
                    
                    @endif 
                   
                    @if ($id=='33')
                        
                    @include('admin/pgperioadmin/formperiodicac1')
                    
                    @endif 
                    
                    @if ($id=='34')
                        
                    @include('admin/pgperioadmin/formperiodicac6')
                    
                    @endif 

                    @if ($id=='35')
                        
                    @include('admin/pgperioadmin/formperiodicac7')
                    
                    @endif 

                    @if ($id=='36')
                        
                    @include('admin/pgperioadmin/formperiodicac8')
                    
                    @endif 

                    @if ($id=='37')
                        
                    @include('admin/pgperioadmin/formperiodicac1')
                    
                    @endif 

                    @if ($id=='38')
                        
                    @include('admin/pgperioadmin/formperiodicac9')
                    
                    @endif

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection