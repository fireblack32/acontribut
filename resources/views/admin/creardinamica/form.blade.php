<label for="nombreob" class="col-lg-3 col-form-label requerido">Programación de Obligaciones Dinamicas </label>

<div class="col-lg-8">Seleccione la obligacion dinamica</div>

<div class="col-lg-8">
    <select id="obligacion" name="obligacion" class="form-control" >
        <option></option>    
        @foreach( $obligacionesdin as $key => $value )
        <option value="{{ $value }}">{{ $key }}</option>
        @endforeach
    </select>
</div>