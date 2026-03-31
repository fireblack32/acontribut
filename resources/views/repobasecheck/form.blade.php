@php
                                    
{{
    
    $mytime = date("Y-m-01");
    $mytimeend = date("Y-m-t");
   

   
    
}}
@endphp

<label for="cliente" class="col-lg-3 col-form-label requerido">Cliente</label>
    <div class="col-lg-8">
        <select id="cliente" name="cliente" class="form-control" >
            <option></option>    
            @foreach( $cliente as $key => $value )
                <option value="{{ $value }}">{{ $key }}</option>
            @endforeach
        </select>
</div>
<div class="form-check">
        <input class="form-check-input" type="radio" name="activo" id="activo" value="1" checked>
        <label class="form-check-label" for="activo">Activo</label>
</div>
<div class="form-check">
        <input class="form-check-input" type="radio" name="activo" id="activo" value="0">
        <label class="form-check-label" for="activo"> Inactivo</label>
</div>
<label for="fecha_ven" class="col-lg-3 col-form-label requerido">Fecha inicial</label>
<div class="col-lg-8">
    <input type="date" name="Fechaini" id="Fechaini" class="form-control" value="{{old('Fecha', $data->Fecha ?? "$mytime")}}" />
</div>
<label for="fecha_ven" class="col-lg-3 col-form-label requerido">Fecha final</label>
<div class="col-lg-8">
    <input type="date" name="Fechafin" id="Fechafin" class="form-control" value="{{old('Fecha', $data->Fecha ?? "$mytimeend")}}" />
</div>
<label for="obligacion" class="col-lg-3 col-form-label requerido">Obligación</label>
    <div class="col-lg-8">
        <select id="obligacion" name="obligacion" class="form-control" >
            <option></option>    
            @foreach($obligaciones as $key => $value )
                <option value="{{ $value }}">{{ $key }}</option>
            @endforeach
        </select>
</div>
<label for="estado" class="col-lg-3 col-form-label">Estado</label>
<div class="col-lg-8">
<label class="checkbox-inline"><input type="checkbox" name='estadoobl1' value="1" checked>Pendiente</label>
<label class="checkbox-inline"><input type="checkbox" name='estadoobl2' value="2" checked>En proceso</label>
<label class="checkbox-inline"><input type="checkbox" name='estadoobl3' value="3" checked>Finalizado sin revisión</label>
</div>
<div class="col-lg-8">
<label class="checkbox-inline"><input type="checkbox" name='estadoobl4' value="4" checked>Segunda revisión</label>
<label class="checkbox-inline"><input type="checkbox" name='estadoobl5' value="5" checked>Revisado SGC</label>
<label class="checkbox-inline"><input type="checkbox" name='estadoobl6' value="6" checked>Revisado y Aprobado</label>
</div>
<div class="col-lg-8">
<label class="checkbox-inline"><input type="checkbox" name='estadoobl7' value="7">Entregado al cliente</label>
</div>
<label for="usuario" class="col-lg-3 col-form-label requerido">Usuario</label>
<div class="col-lg-8">
        <select id="usuario" name="usuario" class="form-control">
            <option></option>    
            @foreach($usuarios as $key => $value )
                <option value="{{ $value }}">{{ $key }}</option>
            @endforeach
        </select>
</div>
