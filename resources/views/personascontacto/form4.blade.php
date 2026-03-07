@php
{{
    
        $database =Config::get('database.connections.'.Config::get('database.default'));
        $database_name=$database['database'];
        $database_host = $database['host'];
        $database_password =  $database['password'];
        $database_user =  $database['username'];
        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
        
        
        $queryact="SELECT  `id`, `cliente_idcliente`, `Nombre`, `Telefono`, `Cargo`, `Observaciones`  FROM `lista_contactos` WHERE `id`='$idrespuesta'";
        //dd($queryact);
        $resultbusq=mysqli_query($conn,$queryact);

        while ($row = mysqli_fetch_array($resultbusq)){
        $id=$row["id"];
        $cliente=$row["cliente_idcliente"];
        $nombre=$row["Nombre"];
        $movil=$row["Telefono"];
        $cargo=$row["Cargo"];
        $observaciones=$row["Observaciones"];
        
        }     
          
    
}}
@endphp


<label for="id" class="col-lg-3 col-form-label requerido">Id Cliente</label>
    <div class="col-lg-8">
    <input type="text" name="id" id="id" class="form-control" value="{{$id}}" required/>
    </div>
<label for="cliente" class="col-lg-3 col-form-label requerido">Cliente</label>
    <div class="col-lg-8">
    <input type="text" name="cliente" id="cliente" class="form-control" value= "{{$cliente}}" required/>
    </div>

<label for="nombre" class="col-lg-3 col-form-label requerido">Nombre</label>
    <div class="col-lg-8">
    <input type="text" name="nombre" id="nombre" class="form-control" value= "{{$nombre}}" required/>
    </div>

<label for="movil" class="col-lg-3 col-form-label requerido">Telefono</label>
    <div class="col-lg-8">
    <input type="text" name="movil" id="movil" class="form-control" value= "{{$movil}}" required/>
    </div>
<label for="cargo" class="col-lg-3 col-form-label requerido">Cargo</label>
    <div class="col-lg-8">
    <input type="text" name="cargo" id="cargo" class="form-control" value= "{{$cargo}}" required/>
    </div>

<label for="observaciones" class="col-lg-3 col-form-label requerido">Observaciones</label>
    <div class="col-lg-8">
    <input type="text" name="observaciones" id="observaciones" class="form-control" value= "{{$observaciones}}" required/>
    </div>


        <div class="col-lg-3">
            @include('includes.boton-form-guardar')
        </div>
  
        <label for="capitalext" class="col-lg-3 col-form-label "></label>
        <div class="col-lg-8">
        </div>
        <label for="capitalext" class="col-lg-3 col-form-label "></label>
        <div class="col-lg-8">
        </div>
   
    