@php
                                    
{{
    $mytime = date('Y-m-d');
   
    
}}
@endphp

<div class="form-group row">
    <label for="fecha_ven" class="col-lg-3 col-form-label requerido">Fecha inicial</label>
    <div class="col-lg-8">
    <input type="date" name="Fechaini" id="Fechaini" class="form-control" value="{{old('Fecha', $data->Fecha ?? "$mytime")}}" required/>
    </div>
    <label for="fecha_ven" class="col-lg-3 col-form-label requerido">Fecha final</label>
    <div class="col-lg-8">
    <input type="date" name="Fechafin" id="Fechafin" class="form-control" value="{{old('Fecha', $data->Fecha ?? "$mytime")}}" required/>
    </div>