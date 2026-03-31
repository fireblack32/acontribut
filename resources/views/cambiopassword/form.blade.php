
    <label for="usuario" class="col-lg-3 col-form-label requerido">usuario</label>
    <div>
    <input type="text" name="usuario" id="usuario" class="form-control" value="{{old('usuario', $id ?? '')}}" required/>
   </div>
    <label for="password" class="col-lg-3 col-form-label requerido">Password</label>
    <div>
    <input type="password" name="password" id="password" class="form-control" value="{{old('password', $datas->password ?? '')}}" required/>
    </div>
    <label for="copassword" class="col-lg-3 col-form-label requerido">Confirmar Password</label>
    <div>
    <input type="password" name="copassword" id="copassword" class="form-control" value="{{old('copassword', $datas->copassword ?? '')}}" required/>
    </div>
