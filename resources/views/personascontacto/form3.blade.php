@php
{{
    
$nombre='';   
$movil='';
$cargo='';
$observaciones='';   
    
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

<label for="nombre" class="col-lg-3 col-form-label requerido">Nombre</label>
    <div class="col-lg-8">
    <input type="text" name="nombre" id="nombre" class="form-control" value= "{{$nombre}}" required/>
    </div>

<label for="movil" class="col-lg-3 col-form-label requerido">Telefono</label>
    <div class="col-lg-8">
    <input type="text" name="movil" id="movil" class="form-control" value= "{{$movil}}" required/>
    </div>
<label for="cargo" class="col-lg-3 col-form-label requerido">Cargo</label>
    <div class="col-lg-8">
    <input type="text" name="cargo" id="cargo" class="form-control" value= "{{$cargo}}" required/>
    </div>

<label for="observaciones" class="col-lg-3 col-form-label requerido">Observaciones</label>
    <div class="col-lg-8">
    <input type="text" name="observaciones" id="observaciones" class="form-control" value= "{{$observaciones}}" required/>
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
   
    