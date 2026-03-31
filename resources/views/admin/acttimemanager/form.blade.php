<div class="form-group row">
    <label for="Descripcion" class="col-lg-3 col-form-label requerido">Descripción</label>
    <div class="col-lg-8">
    <input type="text" name="Descripcion" id="Descripcion" class="form-control" value="{{old('Descripcion', $data->Descripcion ?? '')}}" required/>
    </div>
    <label for="orden" class="col-lg-3 col-form-label requerido">Orden</label>
    <div class="col-lg-8">
    <input type="text" name="orden" id="orden" class="form-control" value="{{old('orden', $data->orden ?? '')}}" required/>
    </div>
    <label for="IdGrupo" class="col-lg-3 col-form-label requerido">ID Grupo</label>
    <div class="col-lg-8">
        <select id="IdGrupo" name="IdGrupo" class="form-control" required>
            <option></option>    
            @foreach( $grupotm as $key => $value )
                <option value="{{ $value }}">{{ $key }}</option>
            @endforeach
     </select>
    </div>  
    <div></div>


</div>