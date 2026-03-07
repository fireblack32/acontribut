@php

$ruta_final="informe_acta_cliente(".date('Y-m-d_H:i:s').").doc";
$docfile=$ruta_final;
@header('Content-type: application/octet-stream'); 
@header('Content-disposition: attachment; filename='.$docfile)
@endphp

@extends("theme.$theme.layout2")
@section('titulo')
    Acta Conocimiento Cliente
@endsection
@section('contenido')
<div class="row">
    <div class="col-lg-12">
          
        <div class="card-body">
                    @include('actaconcliente.form3')
        </div>
        
    </div>
</div>
@endsection