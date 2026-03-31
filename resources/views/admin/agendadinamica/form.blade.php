@extends("theme.$theme.layout")
@section('titulo')
Agendar obligaciones
@endsection

@section("scripts")
<script src="{{asset("Assets\lte\pages\scripts\admin\menu\index.js")}}" type="text/javascript"></script>
@endsection

@section('contenido')
<div class="row">
    <div class="col-lg-12">
        @include('includes.mensajes')
        
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Agendar obligaciones</h3>
                
                
            </div>
            <div class="card-body">
                <form action="{{route('mispendientes_fechas')}}" id="form-general" method="POST" class="form-horizontal" autocomplete="off">
                    @csrf
                 <div class="card-body">
                        
                 </div>
                 <div class="card-footer">
                    <div class="col-lg-3"></div>
                </div>
                <div class="card-body table-responsive p-0">
                    <tbody>
                      <div class="card-body table-responsive p-0">
                        <table  class="table table-striped table-bordered table-hover"  id="tabla-data">
                            <thead>
                                <tr>
                                    @php
                                    
                                    {{
                                            $usuario_id=session()->get('usuario_id');
                                        if ($usuario_id!=''){
                                            $query='SELECT idobligaciones, nombre, tabla_obligacion FROM obligaciones WHERE DinamicaC=1 ORDER BY nombre';
                                            //$result=DB::select($query);//realiza un query
                                            //$result = json_decode(json_encode($result), true);
                                            $database =Config::get('database.connections.'.Config::get('database.default'));
                                            $database_name=$database['database'];
                                            $database_host = $database['host'];
                                            $database_password =  $database['password'];
                                            $database_user =  $database['username'];
                                            $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
                                            $result2=mysqli_query($conn,$query);
                                
                                            while($row=mysqli_fetch_array($result2)){
                                                $obligacion=$row["idobligaciones"];
                                                $nombre=$row["nombre"];
                                                $table=$row["tabla_obligacion"];

                                                //echo $obligacion;

                                                if($obligacion=="16" or $obligacion=="43" or $obligacion=="44" or $obligacion=="57"  or $obligacion=="59"){
                                                
                                                    $querytab='SELECT (SELECT o.`nombre` FROM `obligaciones` o WHERE o. `idobligaciones`=f.`idObligacion`)as Nombre, `fecha`, `Digitos`, `Numero`, `Dias_H_Encargado` as Dias_Enc, `Dias_H_Cliente` as Dias_C, f.`caracteristicas`as IdT, (SELECT `descripcion` FROM `tipo_declaracion_renta` WHERE `idtipo_declaracion_renta`=SUBSTRING(`caracteristicas`,-1,1))as Tipo , f.`Id_Oblig_Dina_almacenadas`as Id FROM `obligaciones_dinamicas_almacenadas` f WHERE `idObligacion`='.$obligacion.' and `Agenda`=0 ORDER BY fecha, Numero';
                                                    //echo $querytab.'<tr>';
                                                
                                                    echo Funciontabla::maketablebuscar($querytab,'agendinamica2',$table,$nombre);
                                                }

                                                if($obligacion=="18"){
                                                
                                                    $querytab='SELECT (SELECT o.`nombre` FROM `obligaciones` o WHERE o. `idobligaciones`=f.`idObligacion`)as Nombre,`fecha`, `Digitos`, `Numero`, `Dias_H_Encargado` as Dias_Enc, `Dias_H_Cliente` as Dias_C, (SELECT `descripcion` FROM `tipo_soi` WHERE `idtipo_soi`=`caracteristicas`)as Tipo, f.`Id_Oblig_Dina_almacenadas`as Id     FROM `obligaciones_dinamicas_almacenadas` f  WHERE `idObligacion`=18 and `Agenda`=0 ORDER BY fecha, Numero';
                                                    //echo $querytab.'<tr>';
                                            
                                                    echo Funciontabla::maketablebuscar($querytab,'agendinamica2',$table,$nombre);
                                                }

                                                if($obligacion=="19"){
                                                
                                                    $querytab='SELECT (SELECT o.`nombre` FROM `obligaciones` o WHERE o. `idobligaciones`=f.`idObligacion`)as Nombre, `fecha`, `Digitos`, `Numero`, `Dias_H_Encargado` as Dias_Enc, `Dias_H_Cliente` as Dias_C, (f.`caracteristicas`)as Tipo, f.`Id_Oblig_Dina_almacenadas`as Id FROM `obligaciones_dinamicas_almacenadas` f  WHERE `idObligacion`=19 and `Agenda`=0 ORDER BY fecha, Numero';
                                                    //echo $querytab.'<tr>';
                                            
                                                    echo Funciontabla::maketablebuscar($querytab,'agendinamica2',$table,$nombre);
                                                }

                                                
                                                if($obligacion=="22"){
                                                
                                                    $querytab="SELECT (SELECT o.`nombre` FROM `obligaciones` o WHERE o. `idobligaciones`=f.`idObligacion`)as Nombre, `fecha`, `Digitos`, `Numero`, `Dias_H_Encargado` as Dias_Enc, `Dias_H_Cliente` as Dias_C, (SELECT `descripcion` FROM `tipo_impuesto_patrimonio` WHERE `idtipo_impuesto_patrimonio`=SUBSTRING_INDEX(f.`caracteristicas`,'-','-2'))as Tipo, f.`Id_Oblig_Dina_almacenadas`as Id FROM `obligaciones_dinamicas_almacenadas` f WHERE `idObligacion`=22 and `Agenda`=0 ORDER BY fecha, Numero";
                                                    //echo $querytab.'<tr>';
                                            
                                                    echo Funciontabla::maketablebuscar($querytab,'agendinamica2',$table,$nombre);
                                                }

                                                if($obligacion=="23"){
                                                
                                                    $querytab="SELECT (SELECT o.`nombre` FROM `obligaciones` o WHERE o. `idobligaciones`=f.`idObligacion`)as Nombre, `fecha`, `Digitos`, `Numero`, `Dias_H_Encargado` as Dias_Enc, `Dias_H_Cliente` as Dias_C, (SELECT `descripcion` FROM `tipo_rete_fuente` WHERE `idtipo_rete_fuente`=SUBSTRING_INDEX(f.`caracteristicas`,'-','-1'))as Tipo,f.`Id_Oblig_Dina_almacenadas`as Id 	FROM `obligaciones_dinamicas_almacenadas` f WHERE `idObligacion`=23 and `Agenda`=0 ORDER BY fecha, Numero";
                                                    //echo $querytab.'<tr>';
                                            
                                                    echo Funciontabla::maketablebuscar($querytab,'agendinamica2',$table,$nombre);
                                                }

                                                if($obligacion=="25"){
                                                
                                                    $querytab="SELECT (SELECT o.`nombre` FROM `obligaciones` o WHERE o. `idobligaciones`=f.`idObligacion`)as Nombre, `fecha`, `Digitos`, `Numero`, `Dias_H_Encargado` as Dias_Enc, `Dias_H_Cliente` as Dias_C, (SELECT `descripcion` FROM `tipo_super_sociedades` WHERE `idtipo_super_sociedades`=SUBSTRING_INDEX(f.`caracteristicas`,'-','-1'))as Tipo, f.`Id_Oblig_Dina_almacenadas`as Id FROM `obligaciones_dinamicas_almacenadas` f WHERE `idObligacion`=25 and `Agenda`=0 ORDER BY fecha, Numero";
                                                    //echo $querytab.'<tr>';
                                            
                                                    echo Funciontabla::maketablebuscar($querytab,'agendinamica2',$table,$nombre);
                                                }

                                                if($obligacion=="17" or $obligacion=="20" or $obligacion=="21" or $obligacion=="24" or $obligacion=="26" or $obligacion=="45" or $obligacion=="46" or $obligacion=="47" or $obligacion=="48" or $obligacion=="49" or $obligacion=="50" or $obligacion=="51" or $obligacion=="52" or $obligacion=="53" or $obligacion=="54" or $obligacion=="55" or $obligacion=="56" or $obligacion=="58" or $obligacion=="67" or $obligacion=="68"  or $obligacion=="69"  or $obligacion=="70"  or $obligacion=="71"  or $obligacion=="72" or $obligacion=="73"){
                                                
                                                    $querytab='SELECT (SELECT o.`nombre` FROM `obligaciones` o WHERE o. `idobligaciones`=f.`idObligacion`)as Nombre,`fecha`, `Digitos`, `Numero`, `Dias_H_Encargado` as Dias_Enc, `Dias_H_Cliente` as Dias_C, f.`Id_Oblig_Dina_almacenadas`as Id FROM `obligaciones_dinamicas_almacenadas` f WHERE `idObligacion`='.$obligacion.' and `Agenda`=0 ORDER BY fecha, Numero';
                                                    //echo $querytab.'<tr>';
                                            
                                                    echo Funciontabla::maketablebuscar($querytab,'agendinamica2',$table,$nombre);
                                                }

                                                if($obligacion=="60" or $obligacion=="61" or $obligacion=="62" or $obligacion=="63" or $obligacion=="64" or $obligacion=="65" or $obligacion>="66"){
                                                
                                                    $querytab='SELECT (SELECT o.`nombre` FROM `obligaciones` o WHERE o. `idobligaciones`=f.`idObligacion`)as Nombre,`fecha`, `Digitos`, `Numero`, `Dias_H_Encargado` as Dias_Enc, `Dias_H_Cliente` as Dias_C, f.`caracteristicas`as IdT, (SELECT `descripcion` FROM `tipo_declaracion_renta`  WHERE `idtipo_declaracion_renta`=SUBSTRING(`caracteristicas`,-1,1))as Tipo, f.`Id_Oblig_Dina_almacenadas`as Id FROM `obligaciones_dinamicas_almacenadas` f WHERE `idObligacion`='.$obligacion.' and `Agenda`=0 ORDER BY fecha, Numero';
                                                    //echo $querytab.'<tr>';
                                            
                                                    echo Funciontabla::maketablebuscar($querytab,'agendinamica2',$table,$nombre);
                                                }

                                                }
                                            
                                                echo '</tr>';
                                                                       
                                            }
                                            
                                            
                                            
                                            
                                        }}
                                @endphp
                                </tr> 
                            </thead>
                        </table>  
                      </div> 
                               
                    </tbody>
                        <!-- /.card-body -->
                         
                </div>
                        <!-- /.card-footer -->
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection
