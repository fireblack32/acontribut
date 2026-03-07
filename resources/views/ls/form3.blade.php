@php
{{
    
$documento=''; 
$nombre='';   
$apellido='';  
$fijo=''; 
$movil='';
$porc='';
$pais='';   
$mail='';                                
    
}}
@endphp


<label for="id" class="col-lg-3 col-form-label requerido">Id Cliente</label>
    <div class="col-lg-8">
    <input type="text" name="id" id="id" class="form-control" value="{{$id}}" required/>
    </div>
<label for="cliente" class="col-lg-3 col-form-label requerido">Cliente</label>
    <div class="col-lg-8">
    <input type="text" name="cliente" id="cliente" class="form-control" value= "{{$cliente}}" required/>
    </div>
<label for="documento" class="col-lg-3 col-form-label requerido">Documento</label>
    <div class="col-lg-8">
    <input type="text" name="documento" id="documento" class="form-control" value= "{{$documento}}" required/>
    </div>
<label for="nombre" class="col-lg-3 col-form-label requerido">Nombre</label>
    <div class="col-lg-8">
    <input type="text" name="nombre" id="nombre" class="form-control" value= "{{$nombre}}" required/>
    </div>
<label for="apellido" class="col-lg-3 col-form-label requerido">Apellido</label>
    <div class="col-lg-8">
    <input type="text" name="apellido" id="apellido" class="form-control" value= "{{$apellido}}" required/>
    </div>
<label for="fijo" class="col-lg-3 col-form-label requerido">Telefono Fijo</label>
    <div class="col-lg-8">
    <input type="text" name="fijo" id="fijo" class="form-control" value= "{{$fijo}}" required/>
    </div>
<label for="movil" class="col-lg-3 col-form-label requerido">Celular</label>
    <div class="col-lg-8">
    <input type="text" name="movil" id="movil" class="form-control" value= "{{$movil}}" required/>
    </div>
<label for="porc" class="col-lg-3 col-form-label requerido">Porcentaje de Participación</label>
    <div class="col-lg-8">
    <input type="text" name="porc" id="porc" class="form-control" value= "{{$porc}}" required/>
    </div>
<label for="mail" class="col-lg-3 col-form-label requerido">Mail</label>
    <div class="col-lg-8">
    <input type="text" name="mail" id="mail" class="form-control" value= "{{$mail}}" required/>
    </div>
<label for="pais" class="col-lg-3 col-form-label requerido">Pais</label>
    <div class="col-lg-8">
    <input type="text" name="pais" id="pais" class="form-control" value= "{{$pais}}" required/>
    </div>


        <div class="col-lg-3">
            @include('includes.boton-form-guardar')
        </div>
  
        <label for="capitalext" class="col-lg-3 col-form-label "></label>
        <div class="col-lg-8">
        </div>
        <label for="capitalext" class="col-lg-3 col-form-label "></label>
        <div class="col-lg-8">
        </div>
   
    