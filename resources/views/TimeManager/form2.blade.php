<div class="form-group row">
    <label for="fecha_ven" class="col-lg-3 col-form-label requerido">Fecha de Busqueda</label>
    <div class="col-lg-8">
    <input type="date" name="Fecha_Busqueda" id="Fecha_Busqueda" class="form-control" value="{{old('Fecha_Busqueda', $data->Fecha_Busqueda ?? '')}}" required/>
    </div>