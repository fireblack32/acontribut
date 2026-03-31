@extends("theme.$theme.layout")
@section('titulo')
    Seleccione tipo de Obligación
@endsection

@section("scripts")
<script src="{{asset("assets/pages/scripts/admin/crear.js")}}" type="text/javascript"></script>
@endsection

@section('contenido')
<div class="row">
    <div class="col-lg-12">
        @include('includes.form-error')
        @include('includes.mensajes')
        @include('includes.mensajes2')
        <div class="card-primary">
            <div class="card-header">
                <h3 class="card-title">Programar Obligación 
               </h3>
                
            </div>
            <div class="card card-info text-center">
                <div class="card-header">
                    <h3 class="card-title text-center">NIT O DOCUMENTO DEL CLIENTE: {{$cliente}}</h3><br>
                    @php
                    {{
                        
                        $query2="SELECT `id`, `nombre` FROM  `cliente` WHERE  `id`='$cliente'";
                            //echo $query2;
                            $database =Config::get('database.connections.'.Config::get('database.default'));
                            $database_name=$database['database'];
                            $database_host = $database['host'];
                            $database_password =  $database['password'];
                            $database_user =  $database['username'];
                            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                            $resultadosest1=mysqli_query($conn,$query2);
                                                
                            while ($row1 = mysqli_fetch_array($resultadosest1)){
                            $nombreexp=$row1["nombre"];
                            }
                        
                    }}
                    @endphp

                    <h3 class="card-title text-center">NOMBRE: {{$nombreexp}}</h3> 
                </div>
            
                @csrf  
                <div class="card-body">
                    @php
                    {{
                        if($obligacion=='1'){
                        $query="SELECT DISTINCT `cliente_idcliente` as Cliente ,
                        (select `nombre` from `obligaciones`where `idobligaciones`=`obligaciones_idobligaciones`)as Nombre,`obligaciones_idobligaciones`as Identificador 
                        FROM `cliente_has_obligaciones` WHERE `obligaciones_idobligaciones`< '15' and `cliente_idcliente`='$cliente' order by Nombre ";
                        
                        echo Funciontabla::maketablebuscar($query,'ocasional',$cliente,$nombreexp);

                        $query="SELECT `idobligaciones`, `nombre`, `tabla_obligacion` FROM `obligaciones` where `idobligaciones` < '15' ORDER BY nombre";
                        $database =Config::get('database.connections.'.Config::get('database.default'));
                        $database_name=$database['database'];
                        $database_host = $database['host'];
                        $database_password =  $database['password'];
                        $database_user =  $database['username'];
                        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                        $resultados=mysqli_query($conn,$query);
                                                
                        while ($row = mysqli_fetch_array($resultados)){
                        
                            $idobligaciones=$row["idobligaciones"];
                            $table=$row["tabla_obligacion"];
                            $nombre=$row["nombre"];
                            $query2="SELECT t.`id` as ID,t.`fecha`,t.`cliente_idcliente`,(SELECT c.`nombre` FROM `cliente` c WHERE c.`id`=t.`cliente_idcliente`)as Nombre, (SELECT u.`usuario` FROM `usuario_web` u WHERE u.`id`=t.`idusuario_web`)as Usuario FROM $table t
			                where t.`fecha` >= CURDATE() and t.`cliente_idcliente`='$cliente'";

                            echo Funciontabla::maketableborrar($query2,'borrar_municipio','id');

                        }


                        }

                        if($obligacion=='2'){

                        $query="SELECT `cliente_idcliente` as Cliente, (select `nombre` from `obligaciones`where `idobligaciones`=`obligaciones_idobligaciones`)as Nombre,`obligaciones_idobligaciones`as Identificador 
                        FROM `cliente_has_obligaciones` WHERE `obligaciones_idobligaciones` > '26' and `obligaciones_idobligaciones` < '39' and `cliente_idcliente`='$cliente' ORDER BY Nombre";
                        
                        echo Funciontabla::maketablebuscar($query,'periodica',$cliente,$nombreexp);

                        $query="SELECT `idobligaciones`, `nombre`, `tabla_obligacion` FROM `obligaciones` where `idobligaciones` > '26' and `idobligaciones` < '39' ORDER BY nombre";
                        $database =Config::get('database.connections.'.Config::get('database.default'));
                        $database_name=$database['database'];
                        $database_host = $database['host'];
                        $database_password =  $database['password'];
                        $database_user =  $database['username'];
                        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                        $resultados=mysqli_query($conn,$query);
                                                
                        while ($row = mysqli_fetch_array($resultados)){
                        
                            $idobligaciones=$row["idobligaciones"];
                            $table=$row["tabla_obligacion"];
                            $nombre=$row["nombre"];
                            $year_y=date('Y');
                            $query2="SELECT t.`id` as ID,t.`fecha`,t.`id`,(SELECT c.`nombre` FROM `cliente` c WHERE c.`id`=t.`id`)as Nombre, (SELECT u.`usuario` FROM `usuario_web` u WHERE u.`id`=t.`id`)as Usuario FROM $table t where t.`fecha` LIKE '$year_y%' and t.`id`='$cliente'";

                            echo Funciontabla::maketableborrar($query2,'borrar_municipio','id');

                        }

                        }

                        if($obligacion=='3'){
                        $query="SELECT `cliente_idcliente` as Cliente ,
                        (select `nombre` from `obligaciones`where `idobligaciones`=`obligaciones_idobligaciones`)as Nombre,`obligaciones_idobligaciones`as Identificador 
                        FROM `cliente_has_obligaciones` WHERE `obligaciones_idobligaciones` = '15' and `cliente_idcliente`='$cliente' ";
                        
                        echo Funciontabla::maketablebuscar($query,'administrable',$cliente,$nombreexp);

                        $query="SELECT `idobligaciones`, `nombre`, `tabla_obligacion` FROM `obligaciones` where `idobligaciones`= '15' ORDER BY nombre";
                        $database =Config::get('database.connections.'.Config::get('database.default'));
                        $database_name=$database['database'];
                        $database_host = $database['host'];
                        $database_password =  $database['password'];
                        $database_user =  $database['username'];
                        $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                        $resultados=mysqli_query($conn,$query);
                                                
                        while ($row = mysqli_fetch_array($resultados)){
                        
                            $idobligaciones=$row["idobligaciones"];
                            $table=$row["tabla_obligacion"];
                            $nombre=$row["nombre"];
                           
                            $query3="SELECT t.`id` as ID,t.`fecha`,t.descripcion,t.`cliente_idcliente`,(SELECT c.`nombre` FROM `cliente` c WHERE c.`id`=t.`cliente_idcliente`)as Nombre, (SELECT u.`usuario` FROM `usuario_web` u WHERE u.`id`=t.`idusuario_web`)as Usuario FROM $table t
			                where t.`fecha` >= CURDATE() and t.`cliente_idcliente`='$cliente'";

                            echo Funciontabla::maketableborrar($query3,'borrar_municipio','id');

                        }


                        }
                    
                        
                    
                    
                    }}
                    @endphp

                    
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection