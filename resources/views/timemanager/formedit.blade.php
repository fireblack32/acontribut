<div class="form-group row">
    <label for="fecha_ini" class="col-lg-3 col-form-label requerido">Fecha de Inicio</label>
    <div class="col-lg-8">
    <input type="date" name="fecha_ini" id="fecha_ini" class="form-control" max="{{ date('Y-m-d', strtotime('-1 day')) }}" min="{{ date('Y-m-d', strtotime('-20 days')) }}" required/>
 </div>
 
    <label for="fecha_fin" class="col-lg-3 col-form-label requerido">Fecha de Finalización</label>
    <div class="col-lg-8">
    <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" value=value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}" required/>
 </div>