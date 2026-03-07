@php
                                    
{{
    
    $mytime = date("Y-m-01");
    $mytimeend = date("Y-m-t");
   

   
    
}}
@endphp

<label for="fecha_ven" class="col-lg-3 col-form-label requerido">Fecha inicial</label>
<div class="col-lg-8">
    <input type="date" name="Fechaini" id="Fechaini" class="form-control" value="{{old('Fecha', $data->Fecha ?? "$mytime")}}" />
</div>
<label for="fecha_ven" class="col-lg-3 col-form-label requerido">Fecha final</label>
<div class="col-lg-8">
    <input type="date" name="Fechafin" id="Fechafin" class="form-control" value="{{old('Fecha', $data->Fecha ?? "$mytimeend")}}" />
</div>
<label for="cliente" class="col-lg-3 col-form-label">Cliente</label>
    <div class="col-lg-8">
        <select id="cliente" name="cliente" class="form-control" >
            <option></option>    
            @foreach( $cliente as $key => $value )
                <option value="{{ $value }}">{{ $key }}</option>
            @endforeach
        </select>
</div>
<label for="usuario" class="col-lg-3 col-form-label">Usuario</label>
<div class="col-lg-8">
        <select id="usuario" name="usuario" class="form-control">
            <option></option>    
            @foreach($usuarios as $key => $value )
                <option value="{{ $value }}">{{ $key }}</option>
            @endforeach
        </select>
</div>
<label for="actividad" class="col-lg-3 col-form-label">Actividad</label>
<div class="col-lg-8">
        <select id="actividad" name="actividad" class="form-control">
            <option></option>    
            @foreach($actividad as $key => $value )
                <option value="{{ $value }}">{{ $key }}</option>
            @endforeach
        </select>
</div>
<label for="grupo" class="col-lg-3 col-form-label">Grupo</label>
<div class="col-lg-8">
        <select id="grupo" name="grupo" class="form-control">
            <option></option>    
            @foreach($grupotimemanager as $key => $value )
                <option value="{{ $value }}">{{ $key }}</option>
            @endforeach
        </select>
</div>