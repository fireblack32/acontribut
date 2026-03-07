<label for="password" class="col-lg-3 col-form-label requerido">usuario</label>
    <div class="col-lg-8">
        <select id="usuario" name="usuario" class="form-control" required>
            <option></option>    
            @foreach( $usuarios as $nombre => $id )
            <option
            value="{{$id}}"
            {{is_array(old('id')) ? (in_array($id, old('id')) ? 'selected' : '')  : (isset($data) ? ($data->roles->firstWhere('id', $id) ? 'selected' : '') : '')}}
            >
            {{$nombre}}
            </option>
            @endforeach
     </select>
    </div>
<label for="password" class="col-lg-3 col-form-label requerido">Password</label>
<div>
<input type="password" name="password" id="password" class="form-control" value="{{old('password', $datas->password ?? '')}}" required/>
</div>
<label for="copassword" class="col-lg-3 col-form-label requerido">Confirmar Password</label>
<div>
<input type="password" name="copassword" id="copassword" class="form-control" value="{{old('copassword', $datas->copassword ?? '')}}" required/>
</div>