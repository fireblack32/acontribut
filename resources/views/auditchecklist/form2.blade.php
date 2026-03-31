
@php
                                    
{{
    $mytime = date('Y-m-d');
   
    
}}
@endphp
<div class="form-group row">
    <label for="fecha_ini" class="col-lg-3 col-form-label requerido">Fecha de Inicio</label>
    <div class="col-lg-8">
    <input type="date" name="fecha_ini" id="fecha_ini" class="form-control" value="{{old('fecha_ini', $data->fecha_ini ?? "$mytime")}}" required/>
 </div>
 
    <label for="fecha_fin" class="col-lg-3 col-form-label requerido">Fecha de Finalización</label>
    <div class="col-lg-8">
    <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" value="{{old('fecha_fin', $data->fecha_fin ?? "$mytime")}}" required/>
 </div>

 <div class="col-lg-8">
 <input type="hidden" name="usuario" id="usuario" class="form-control" value="{{old('usuario', $usuario ?? '')}}" required/>
</div>