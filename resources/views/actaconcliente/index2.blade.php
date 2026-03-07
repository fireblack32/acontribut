

@extends("theme.$theme.layout")
@section('titulo')
    Acta Conocimiento Cliente
@endsection

@section("scripts")
<script src="{{asset("Assets/pages/scripts/admin/crear.js")}}" type="text/javascript"></script>

@endsection

@section('contenido')
<div class="row">
    <div class="col-lg-12">
        @include('includes.form-error')
        @include('includes.mensajes')
        
        <div class="card-primary">
            <div class="card-header">
                <h3 class="card-title">Acta Conocimiento Cliente</h3>
                <div class="card-tools">
                    <a href="{{route('actaconcliente')}}" class="btn btn-outline-info btn-sm">
                        <i class="fa fa-fw fa-reply-all"></i> Volver
                    </a>
                </div>
            </div>
            <div class="card-header">
               <div class="card-tools">
                <tr>
                <td>
                        
                <input type="button" name="imprimir" value="Imprimir" onclick="window.print();"> 

                </td>
                </tr>
                </div>
            </div>
            <form action="{{route('actaconcliente_actualizar')}}" id="form-general" class="form-horizontal form--label-right" method="POST" autocomplete="off">
                @csrf 
                <div class="card-body">
                    @include('actaconcliente.form2')
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            @include('includes.boton-form-editar')
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection