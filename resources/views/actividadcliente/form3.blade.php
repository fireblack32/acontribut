@php
{{
    
    
    $querydescripcion="SELECT `Id`, `Codigo`, `Descripcion` FROM `actividades_economicas`";
    $database =Config::get('database.connections.'.Config::get('database.default'));
    $database_name=$database['database'];
    $database_host = $database['host'];
    $database_password =  $database['password'];
    $database_user =  $database['username'];
    $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
    $resultadoscert=mysqli_query($conn,$querydescripcion);
                                        
    
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


    <label for="actividad" class="col-lg-3 col-form-label requerido">Actividad</label>
    <div class="col-lg-8">
        <select id="actividad" name="actividad" class="form-control" required>
        @while ($rowusuen = mysqli_fetch_array($resultadoscert))
           <option value="{{ $rowusuen["Id"] }}">{{ $rowusuen["Codigo"]}}</option> 
        @endwhile
        </select>
    <label for="orden" class="col-lg-3 col-form-label ">ORDEN:</label>
        <div class="col-lg-8">
            <select id="orden" name="orden" class="form-control" >
                <option value="PRINCIPAL">PRINCIPAL</option>
                <option value="SECUNDARIO">SECUNDARIO</option>
                <option value="OTRO">OTRO</option>
            </select>
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
        <label for="capitalext" class="col-lg-8 col-form-label requerido">ACTIVIDAD (ES) ECONÓMICA (S) SEGÚN RUT:</label>
        <div>
        <tr>
            @php
            
            {{
                        //echo $cliente;
                        
                          echo '<tr>';
                          //echo $querypre;
                          //echo '<div><h2 class=card-title text-center><p><b>tabla:'.$table.' el query es: '.$queryp.'</b></p></h2></div>';
                          echo Funciontabla::maketablesintitulo($querydescripcion);
                          echo '<tr>';
        }}
        @endphp
        </tr> 
        </div>
    