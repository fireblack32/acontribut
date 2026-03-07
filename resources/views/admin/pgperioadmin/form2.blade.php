<label for="obligacion" class="col-lg-3 col-form-label requerido">Tipo Obligación</label>
    <div class="col-lg-8">
        <div class="col-lg-8">
            <select id="obligacion" name="obligacion" class="form-control" required>
                <option selected value="0"></option>
				
				<option  value="2">Periodica</option>
				<option  value="3">Administrable</option>
               
            </select>
    </div>
    <input id="cliente" name="cliente" type="hidden" value="{{$cliente}}">
<br>