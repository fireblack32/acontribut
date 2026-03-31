<div class="form-group row">
    <label for="nombre" class="col-lg-3 col-form-label requerido">Documento</label>
    <div class="col-lg-8">
    <input type="text" name="documento" id="documento" class="form-control" value="{{old('documento', $data->documento ?? '')}}" required/>
    </div>
    <label for="documento" class="col-lg-3 col-form-label requerido">Nombre</label>
    <div class="col-lg-8">
    <input type="text" name="nombre" id="nombre" class="form-control" value="{{old('nombre', $data->nombre ?? '')}}" required/>
    </div>
    <label for="apellidos" class="col-lg-3 col-form-label requerido">Apellidos</label>
    <div class="col-lg-8">
    <input type="text" name="apellidos" id="apellidos" class="form-control" value="{{old('apellidos', $data->apellidos ?? '')}}" required/>
    </div>
    <label for="telefono" class="col-lg-3 col-form-label ">Telefono</label>
    <div class="col-lg-8">
    <input type="text" name="telefono" id="telefono" class="form-control" value="{{old('telefono', $data->telefono ?? '')}}" />
    </div>
    <label for="email" class="col-lg-3 col-form-label requerido">E Mail</label>
    <div class="col-lg-8">
    <input type="email" name="email" id="email" class="form-control" value="{{old('email', $data->email ?? '')}}" required/>
    </div>
    <label for="usuario" class="col-lg-3 col-form-label requerido">Usuario</label>
    <div class="col-lg-8">
    <input type="text" name="usuario" id="usuario" class="form-control" value="{{old('usuario', $data->usuario ?? '')}}" required/>
    </div>
    <label for="password" class="col-lg-3 col-form-label requerido">Perfil</label>
    <div class="col-lg-8">
        <select id="perfil_idperfil" name="perfil_idperfil" class="form-control" required>
            <option></option>    
            @foreach( $roles as $nombre => $id )
            <option
            value="{{$id}}"
            {{is_array(old('rol_id')) ? (in_array($id, old('rol_id')) ? 'selected' : '')  : (isset($data) ? ($data->roles->firstWhere('id', $id) ? 'selected' : '') : '')}}
            >
            {{$nombre}}
            </option>
            @endforeach
     </select>
    </div>
    <label for="fecha_ven" class="col-lg-3 col-form-label requerido">Fecha de Venc</label>
    <div class="col-lg-8">
    <input type="date" name="fecha_ven" id="fecha_ven" class="form-control" value="{{old('fecha_ven', $data->fecha_ven ?? '')}}" required/>
    </div>
    <label for="estado" class="col-lg-3 col-form-label requerido">Estado</label>
    <div class="col-lg-8">
        <select id="estado" name="estado" class="form-control" required>
            <option value="1">Activo</option>
            <option value="0">Bloqueado</option>
        </select>
    </div>
    <div></div>


</div>