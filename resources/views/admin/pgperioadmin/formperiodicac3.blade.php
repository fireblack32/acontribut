@php
{{
    $usuario_en='';

    $querydescripcion="SELECT `nombre` FROM `obligaciones` WHERE `idobligaciones`='$id'";
    $database =Config::get('database.connections.'.Config::get('database.default'));
    $database_name=$database['database'];
    $database_host = $database['host'];
    $database_password =  $database['password'];
    $database_user =  $database['username'];
    $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
    $resultadosdescripcion=mysqli_query($conn,$querydescripcion);
                                        
    while ($row = mysqli_fetch_array($resultadosdescripcion)){
        $nombre=$row["nombre"];
    }

    $queryencargado="SELECT idusuario_web_encargado 
                        FROM cliente_has_obligaciones 
                        WHERE cliente_idcliente = ".$cliente." 
                        AND obligaciones_idobligaciones = ".$id." 
                        ORDER BY fecha_rev DESC 
                        LIMIT 1";
    $database =Config::get('database.connections.'.Config::get('database.default'));
    $database_name=$database['database'];
    $database_host = $database['host'];
    $database_password =  $database['password'];
    $database_user =  $database['username'];
    $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
    $resultadoencargado=mysqli_query($conn,$queryencargado);
                                        
    while ($row = mysqli_fetch_array($resultadoencargado)){
        $encargado=$row["idusuario_web_encargado"];
    }

    
    $queryusu="SELECT  `id`,`usuario`  FROM `usuario_web` where `estado`='1' ORDER BY usuario";
    $database =Config::get('database.connections.'.Config::get('database.default'));
    $database_name=$database['database'];
    $database_host = $database['host'];
    $database_password =  $database['password'];
    $database_user =  $database['username'];
    $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
    $resultadousu=mysqli_query($conn,$queryusu);
                                        
    $querycert="SELECT * FROM tipo_exp_cert_bimensuales";
    $database =Config::get('database.connections.'.Config::get('database.default'));
    $database_name=$database['database'];
    $database_host = $database['host'];
    $database_password =  $database['password'];
    $database_user =  $database['username'];
    $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
    $resultadoscert=mysqli_query($conn,$querycert);

    $queryper="SELECT * FROM `periodo_exp_cert_bimensuales`";
    $database =Config::get('database.connections.'.Config::get('database.default'));
    $database_name=$database['database'];
    $database_host = $database['host'];
    $database_password =  $database['password'];
    $database_user =  $database['username'];
    $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
    $resultadosper=mysqli_query($conn,$queryper);

    $mytime = date('Y-m-d');

}}
@endphp


  
    <div class="card-header">
        <h2 class="card-title">{{$nombre}}</h2>
    </div>
    
    <label for="fecha_ini" class="col-lg-3 col-form-label requerido">Fecha</label>
    <div class="col-lg-8">
    <input type="date" name="fecha" id="fecha" class="form-control" value="{{old('fecha_ini', $fecha ?? "$mytime")}}" required/>
    </div>
    <label for="apellidos" class="col-lg-3 col-form-label requerido">Días habiles para avisar al encargado</label>
    <div class="col-lg-8">
    <input type="text" name="diasencargado" id="diasencargado" class="form-control" value="{{old('diasencargado', $diasencargado ?? '')}}" required/>
    </div>
    <label for="apellidos" class="col-lg-3 col-form-label requerido">Días habiles para avisar al cliente</label>
    <div class="col-lg-8">
    <input type="text" name="diascliente" id="diascliente" class="form-control" value="{{old('diascliente', $diascliente ?? '')}}" required/>
    </div>
    <label for="encargado" class="col-lg-3 col-form-label requerido">Encargado</label>
    <div class="col-lg-8">
        <select id="encargado" name="encargado" class="form-control" required>
        @while ($rowusuen = mysqli_fetch_array($resultadousu))
        @if ($rowusuen["id"]==$encargado)
            <option value="{{ $rowusuen["id"] }}" selected='selected'>{{ $rowusuen["usuario"] }}</option>
        @else
            <option value="{{ $rowusuen["id"] }}">{{ $rowusuen["usuario"] }}</option>    
        @endif  
        @endwhile
        </select>
    </div>
    <label for="certificado" class="col-lg-3 col-form-label requerido">Tipo de Cerficados</label>
    <div class="col-lg-8">
        <select id="certificado" name="certificado" class="form-control" required>
        @while ($rowcert = mysqli_fetch_array($resultadoscert))
        <option value="{{ $rowcert["idtipo_exp_cert_bimensuales"] }}">{{ $rowcert["descripcion"] }}</option>    
        @endwhile
        </select>
    </div>
    <label for="periodicidad" class="col-lg-3 col-form-label requerido">Periodicidad</label>
    <div class="col-lg-8">
        <select id="periodicidad" name="periodicidad" class="form-control" required>
        @while ($rowper = mysqli_fetch_array($resultadosper))
        <option value="{{ $rowper["idperiodo_exp_cert_bimensuales"] }}">{{ $rowper["descripcion"] }}</option>    
        @endwhile
        </select>
    </div>
    <input id="idobligacion" name="idobligacion" type="hidden" value="{{$id}}">
    <input id="cliente" name="cliente" type="hidden" value="{{$cliente}}">
    <div class="col-lg-8">
        @include('includes.boton-form-guardar')
    </div>
