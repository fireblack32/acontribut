<label for="usuario" class="col-lg-3 col-form-label requerido">Usuario</label>
    <div class="col-lg-8">
        <select id="usuario" name="usuario" class="form-control" required>
            <option></option>    
            @foreach( $usuario as $key => $value )
                <option value="{{ $value }}">{{ $key }}</option>
            @endforeach
        </select>
</div>