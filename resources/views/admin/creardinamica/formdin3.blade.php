@php
{{
    $querydec="SELECT `idtipo_declaracion_renta`,`descripcion` 
		FROM `tipo_declaracion_renta` 
		ORDER BY `descripcion`";
    $database =Config::get('database.connections.'.Config::get('database.default'));
    $database_name=$database['database'];
    $database_host = $database['host'];
    $database_password =  $database['password'];
    $database_user =  $database['username'];
    $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
    $resultadosdec=mysqli_query($conn,$querydec);

    $querydescripcion="SELECT `nombre` FROM `obligaciones` WHERE `idobligaciones`='$obligacion'";
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
    $mytime = date('Y-m-d');
}}
@endphp

<div class="card-header">
    <h2 class="card-title">{{$nombre}}</h2>
</div>

<label class="col-lg-8" class="col-lg-3 col-form-label requerido">Numero de Digitos</label>

<div class="col-lg-8">
    <select id="digitos" name="digitos" class="form-control" >  
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
    </select>
</div>
<label for="fecha_ini" class="col-lg-3 col-form-label requerido">Fecha</label>
    <div class="col-lg-8">
    <input type="date" name="fecha" id="fecha" class="form-control" value="{{old('fecha_ini', $fecha ?? "$mytime")}}" required/>
    </div>

<label class="col-lg-8" class="col-lg-3 col-form-label requerido">SOI</label>
    <div class="col-lg-8">
        <select id="soi" name="soi" class="form-control" >  
            <option value="1">Menos de 200 empleados</option>
            <option value="2">Mas de 200 empleados</option>
            <option value="3">Independiente</option>
        </select>
    </div>
<label for="diash" class="col-lg-3 col-form-label requerido">Días hábiles para avisar al encargado</label>
    <div class="col-lg-8">
    <input type="text" name="diash" id="diash" class="form-control" value="{{old('diash', $data->diash ?? '')}}" required/>
    </div>
<label for="diasp" class="col-lg-3 col-form-label requerido">Días hábiles para avisar al cliente</label>
    <div class="col-lg-8">
    <input type="text" name="diasp" id="diasp" class="form-control" value="{{old('diasp', $data->diasp ?? '')}}" required/>
    </div>
<label for="numero" class="col-lg-3 col-form-label requerido">Rango inicial:</label>
    <div class="col-lg-8">
    <input type="text" name="numero" id="numero" class="form-control" value="{{old('numero', $data->numero ?? '')}}" required/>
    </div>
<label for="numero2" class="col-lg-3 col-form-label requerido">Rango final:</label>
    <div class="col-lg-8">
    <input type="text" name="numero2" id="numero2" class="form-control" value="{{old('numero2', $data->numero2 ?? '')}}" required/>
    </div>
    <input id="idobligacion" name="idobligacion" type="hidden" value="{{$obligacion}}">