
<div class="form-group row">
    <label for="id" class="col-lg-3 col-form-label requerido">NIT</label>
    <div class="col-lg-8">
    <input type="text" name="id" id="id" class="form-control" value="{{old('id', $data->id ?? '')}}" required/>
    </div>
    <label for="digito_verificacion" class="col-lg-3 col-form-label requerido">DV</label>
    <div class="col-lg-8">
    <input type="text" name="digito_verificacion" id="digito_verificacion" class="form-control" value="{{old('digito_verificacion', $data->digito_verificacion ?? '')}}" required/>
    </div>
    <label for="nombre" class="col-lg-3 col-form-label requerido">Nombre</label>
    <div class="col-lg-8">
    <input type="text" name="nombre" id="nombre" class="form-control" value="{{old('nombre', $data->nombre ?? '')}}" required/>
    </div>
    <label for="direccion" class="col-lg-3 col-form-label requerido">Dirección</label>
    <div class="col-lg-8">
    <input type="text" name="direccion" id="direccion" class="form-control" value="{{old('direccion', $data->direccion ?? '')}}" required/>
    </div>
    <label for="tel_fijo" class="col-lg-3 col-form-label ">Telefono</label>
    <div class="col-lg-8">
    <input type="text" name="tel_fijo" id="tel_fijo" class="form-control" value="{{old('tel_fijo', $data->tel_fijo ?? '')}}" />
    </div>
    <label for="tel_movil" class="col-lg-3 col-form-label ">Celular</label>
    <div class="col-lg-8">
    <input type="text" name="tel_movil" id="tel_movil" class="form-control" value="{{old('tel_movil', $data->tel_movil ?? '')}}" />
    </div>
    <label for="fax" class="col-lg-3 col-form-label ">Telefono Fax</label>
    <div class="col-lg-8">
    <input type="text" name="fax" id="tel_fijo" class="form-control" value="{{old('fax', $data->fax ?? '')}}" />
    </div>
    <label for="email" class="col-lg-3 col-form-label requerido">E Mail</label>
    <div class="col-lg-8">
    <input type="email" name="email" id="email" class="form-control" value="{{old('email', $data->email ?? '')}}" required/>
    </div>
    <label for="tipo_sociedad_idtipo_sociedad" class="col-lg-3 col-form-label requerido">Tipo de Sociedad</label>
    <div class="col-lg-8">
        <select id="tipo_sociedad_idtipo_sociedad" name="tipo_sociedad_idtipo_sociedad" class="form-control" required>
            <option></option>    
            @foreach( $sociedad as $key => $value )
                @if ($data->tipo_sociedad_idtipo_sociedad==$value)
                <option value="{{ $value }}" selected=selected>{{ $key }}</option>
                @else
                <option value="{{ $value }}">{{ $key }}</option>   
                @endif
            @endforeach
     </select>
    </div>
    <label for="fecha_constitucion" class="col-lg-3 col-form-label">Fecha de Constitución</label>
    <div class="col-lg-8">
    <input type="date" name="fecha_constitucion" id="fecha_constitucion" class="form-control" value="{{old('fecha_constitucion', $data->fecha_constitucion ?? '')}}" />
    </div>
    <label for="fecha_expiracion" class="col-lg-3 col-form-label">Fecha de Expiración</label>
    <div class="col-lg-8">
    <input type="date" name="fecha_expiracion" id="fecha_expiracion" class="form-control" value="{{old('fecha_expiracion', $data->fecha_expiracion ?? '')}}" />
    </div>
    <label for="persona_contacto" class="col-lg-3 col-form-label requerido">Persona de Contacto</label>
    <div class="col-lg-8">
    <input type="text" name="persona_contacto" id="persona_contacto" class="form-control" value="{{old('persona_contacto', $data->persona_contacto ?? '')}}" />
    </div>
    <label for="idusuario_web" class="col-lg-3 col-form-label requerido">Usuario Encargado</label>
    <div class="col-lg-8">
        <select id="idusuario_web" name="idusuario_web" class="form-control" required>
        @foreach( $idusuario_web as $key => $value )
            @if ($data->idusuario_web==$value)
            <option value="{{ $value }}" selected=selected>{{ $key }}</option>
            @else
            <option value="{{ $value }}">{{ $key }}</option>   
            @endif
        @endforeach
     </select>
    </div>
    <label for="id_lider" class="col-lg-3 col-form-label requerido">lider Encargado</label>
    <div class="col-lg-8">
        <select id="id_lider" name="id_lider" class="form-control" required>
            <option></option>    
            @foreach( $idusuario_web as $key => $value )
                @if ($data->id_lider==$value)
                <option value="{{ $value }}" selected=selected>{{ $key }}</option>
                @else
                <option value="{{ $value }}">{{ $key }}</option>   
                @endif
            @endforeach
     </select>
    </div>
    <label for="emailauditor" class="col-lg-3 col-form-label requerido">Email auditor</label>
    <div class="col-lg-8">
        <select id="emailauditor" name="emailauditor" class="form-control" required>
            <option></option>    
            @foreach( $mail_auditor as $key => $value )
            @if ($data->emailauditor==$value)
            <option value="{{ $key}}" selected=selected>{{ $value }}</option>
            @else
            <option value="{{ $key }}">{{ $value }}</option>   
            @endif
        @endforeach
     </select>
    </div>
    <label for="Cauditoria" class="col-lg-3 col-form-label ">Activo Auditoria</label>
    <div class="col-lg-8">
        <select id="Cauditoria" name="Cauditoria" class="form-control" >
            @foreach( $sino as $key => $value )
            @if ($data->Cauditoria==$value)
            <option value="{{$value}}" selected=selected>{{ $key}}</option>
            @else
            <option value="{{ $value }}">{{ $key }}</option>   
            @endif
            @endforeach 
        </select>
    </div>

    <label for="representante_legal" class="col-lg-3 col-form-label requerido">Representante legal</label>
    <div class="col-lg-8">
    <input type="text" name="representante_legal" id="representante_legal" class="form-control" value="{{old('representante_legal', $data->representante_legal ?? '')}}" />
    </div>
    <label for="id_representante_legal" class="col-lg-3 col-form-label requerido">Identificación Representante Legal</label>
    <div class="col-lg-8">
    <input type="text" name="id_representante_legal" id="id_representante_legal" class="form-control" value="{{old('id_representante_legal', $data->id_representante_legal ?? '')}}" />
    </div>
    
    <label for="idcliente_grupo" class="col-lg-3 col-form-label requerido">Grupo Cliente</label>
    <div class="col-lg-8">
    <input type="text" name="idcliente_grupo" id="idcliente_grupo" class="form-control" value="{{old('idcliente_grupo', $data->idcliente_grupo ?? '')}}" />
    </div>
    <label for="periodo_balance" class="col-lg-3 col-form-label requerido">Periodo Balance</label>
    <div class="col-lg-8">
    <input type="text" name="periodo_balance" id="periodo_balance" class="form-control" value="{{old('periodo_balance', $data->periodo_balance ?? '')}}" />
    </div>

    <div></div>


</div>