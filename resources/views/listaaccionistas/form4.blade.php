@php
{{
    
        $database =Config::get('database.connections.'.Config::get('database.default'));
        $database_name=$database['database'];
        $database_host = $database['host'];
        $database_password =  $database['password'];
        $database_user =  $database['username'];
        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
        
        
        $queryact="SELECT `idrepresentante_cliente`, `documento`, `nombres`, `apellidos`, `tel_fijo`, 
        `tel_movil`, `email`, `representante_legal`, `socio`, `junta_directiva`, `cliente_idcliente`, `Porc_Parti`, `Pais`, `BenFin`,  `DocBenFin`,`PartBenFin`
        FROM `representante_cliente` WHERE `idrepresentante_cliente`='$idrespuesta'";
        //dd($queryact);
        $resultbusq=mysqli_query($conn,$queryact);

        while ($row = mysqli_fetch_array($resultbusq)){
        $id=$row["idrepresentante_cliente"];
        $documento=$row["documento"];
        $nombre=$row["nombres"];
        $apellido=$row["apellidos"];
        $fijo=$row["tel_fijo"];
        $movil=$row["tel_movil"];
        $porc=$row["Porc_Parti"];
        $mail=$row["email"];
        $pais=$row["Pais"];
        $cliente_idcliente=$row["cliente_idcliente"];
        $benefin=$row["BenFin"];
        $docbenefin=$row["DocBenFin"];
        $partbenefin=$row["PartBenFin"];
        }     
        
        $queryc="SELECT `nombre` FROM `cliente` WHERE `id`='$cliente_idcliente'";
        $resultbuc=mysqli_query($conn,$queryc);

        while ($row = mysqli_fetch_array($resultbuc)){
            $cliente=$row["nombre"];
        }

    
}}
@endphp


<label for="id" class="col-lg-3 col-form-label requerido">Id Cliente</label>
    <div class="col-lg-8">
    <input type="text" name="id" id="id" class="form-control" value="{{$id}}"  readonly/>
    </div>
<label for="cliente" class="col-lg-3 col-form-label requerido">Cliente</label>
    <div class="col-lg-8">
    <input type="text" name="cliente" id="cliente" class="form-control" value= "{{$cliente}}" readonly/>
    </div>
<label for="documento" class="col-lg-3 col-form-label requerido">Documento</label>
    <div class="col-lg-8">
    <input type="text" name="documento" id="documento" class="form-control" value= "{{$documento}}" required/>
    </div>
<label for="nombre" class="col-lg-3 col-form-label requerido">Nombre</label>
    <div class="col-lg-8">
    <input type="text" name="nombre" id="nombre" class="form-control" value= "{{$nombre}}" required/>
    </div>
<label for="apellido" class="col-lg-3 col-form-label requerido">Apellido</label>
    <div class="col-lg-8">
    <input type="text" name="apellido" id="apellido" class="form-control" value= "{{$apellido}}" required/>
    </div>
<label for="fijo" class="col-lg-3 col-form-label requerido">Telefono Fijo</label>
    <div class="col-lg-8">
    <input type="text" name="fijo" id="fijo" class="form-control" value= "{{$fijo}}" required/>
    </div>
<label for="movil" class="col-lg-3 col-form-label requerido">Celular</label>
    <div class="col-lg-8">
    <input type="text" name="movil" id="movil" class="form-control" value= "{{$movil}}" required/>
    </div>
<label for="porc" class="col-lg-3 col-form-label requerido">Porcentaje de Participación</label>
    <div class="col-lg-8">
    <input type="text" name="porc" id="porc" class="form-control" value= "{{$porc}}" required/>
    </div>
<label for="mail" class="col-lg-3 col-form-label requerido">Mail</label>
    <div class="col-lg-8">
    <input type="text" name="mail" id="mail" class="form-control" value= "{{$mail}}" required/>
    </div>
<label for="pais" class="col-lg-3 col-form-label requerido">Pais</label>
    <div class="col-lg-8">
    <input type="text" name="pais" id="pais" class="form-control" value= "{{$pais}}" required/>
    </div>
<label for="benefin" class="col-lg-3 col-form-label requerido">BENEFICIARIOS_FINALES</label>
    <div class="col-lg-8">
    <input type="text" name="benefin" id="benefin" class="form-control" value= "{{$benefin}}" required/>
    </div>
<label for="docbenefin" class="col-lg-3 col-form-label requerido">DOC BENEFICIARIOS_FINALES</label>
    <div class="col-lg-8">
    <input type="text" name="docbenefin" id="docbenefin" class="form-control" value= "{{$docbenefin}}" required/>
    </div>
<label for="partbenefin" class="col-lg-3 col-form-label requerido">PARTICIPACION BENEFICIARIOS_FINALES</label>
    <div class="col-lg-8">
    <input type="text" name="partbenefin" id="partbenefin" class="form-control" value= "{{$partbenefin}}" required/>
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
   
    