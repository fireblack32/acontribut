<label for="cliente" class="col-lg-3 col-form-label requerido">Cliente</label>
    <div class="col-lg-8">
        <select id="cliente" name="cliente" class="form-control" >
            <option></option>    
            @foreach( $cliente as $key => $value )
                <option value="{{ $value }}">{{ $key }}</option>
            @endforeach
        </select>
</div>
