<label for="cliente" class="col-lg-3 col-form-label requerido">Cliente</label>
    <div class="col-lg-8">
        <div class="col-lg-8">
            <select id="cliente" name="cliente" class="form-control" required>
                <option></option>    
                @foreach( $clientes as $key => $value )
                    <option value="{{ $value }}">{{ $key }}</option>
                @endforeach
            </select>
    </div>
<label for="municipio" class="col-lg-3 col-form-label requerido">Municipio</label>
    <div class="col-lg-8">
        <select id="municipio" name="municipio" class="form-control" required>
            <option></option>    
            @foreach( $municipios as $key => $value )
                <option value="{{ $value }}">{{ $key }}</option>
            @endforeach
        </select>
    </div>
    
