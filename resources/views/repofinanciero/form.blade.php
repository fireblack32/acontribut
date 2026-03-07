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
<label for="estado" class="col-lg-3 col-form-label">Estado</label>
<div class="col-lg-8">
<label class="checkbox-inline"><input type="checkbox" name='estadoobl3' value="3" checked>Finalizado sin revisión</label>
<label class="checkbox-inline"><input type="checkbox" name='estadoobl4' value="4" checked>Segunda revisión</label>
<label class="checkbox-inline"><input type="checkbox" name='estadoobl5' value="5" checked>Revisado SGC</label>
</div>
<div class="col-lg-8">
<label class="checkbox-inline"><input type="checkbox" name='estadoobl6' value="6" checked>Revisado y Aprobado</label>
<label class="checkbox-inline"><input type="checkbox" name='estadoobl7' value="7" checked>Entregado al cliente</label>
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
