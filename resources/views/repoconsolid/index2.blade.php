@extends("theme.$theme.layout")
@section('titulo')
    Reporte Consolidado
@endsection

@section("scripts")
<script src="{{asset("assets/pages/scripts/admin/crear.js")}}" type="text/javascript"></script>
@endsection

@section('contenido')
<div class="row">
    <div class="col-lg-12">
        @include('includes.form-error')
        @include('includes.mensajes')
        <div class="card-primary">
            <div class="card-header">
                <h3 class="card-title">Consulta Reporte Consolidado</h3>
                <div class="card-tools">
                    <a href="{{route('repoconsolid')}}" class="btn btn-outline-info btn-sm">
                        <i class="fa fa-fw fa-reply-all"></i> Volver
                    </a>
                </div>
            </div>
            <br>
            <div class="card-header">
                <h3 class="card-title">Descargar Excel</h3>
                <div class="card-tools">
                    <tr><td><img src={{asset("Assets/images/excel.jpg")}} style='height: 40px; width: 40px; cursor:pointer' alt="Descarga"></td><td>
                    <form action="{{route('repoconsolid_exceldes')}}" id="form-general" class="form-horizontal form--label-right" method="POST" autocomplete="off">
                        @csrf  
                        <input id="Fechaini" name="Fechaini" type="hidden" value="{{$Fechaini}}">
                        <input id="Fechafin" name="Fechafin" type="hidden" value="{{$Fechafin}}">
                        <input id="cliente" name="cliente" type="hidden" value="{{$cliente}}">
                        <input id="usuario" name="usuario" type="hidden" value="{{$usuario}}">
                        <input id="actividad" name="actividad" type="hidden" value="{{$actividad}}">
                        <input id="grupo" name="grupo" type="hidden" value="{{$grupo}}">
                        @include('includes.boton-from-descargar')
                    </form>
                </td></tr>
                </div>
            </div>
            <div class="card-body">
                <table  class="table table-striped table-bordered table-hover"  id="tabla-data">
                    <thead>
                        <tr>
                            @php
                            
                            {{
                           
                            
                                $queryp="SELECT (SELECT u.`nombre` FROM `usuario_web` u WHERE u.`id` = t.`Auditor`) AS Nombre,
                                        t.`Fecha_Registro` AS Fecha,
                                        (SELECT tp.`Descripcion` FROM `tipo_timemanager` tp WHERE tp.`id` = t.`IdTipo_Auditoria`) AS Grupo_Auditoria,
                                        (SELECT c.`nombre` FROM `cliente` c WHERE c.`id` = t.`IdCliente`) AS Cliente,
                                        t.`Observaciones`,
                                        (t.`H_Auditoria` + t.`H_Supervision` + t.`H_Planeacion` + t.`H_SGC`) AS Total_Horas
                                    FROM 
                                        `timemanager` t
                                        INNER JOIN `tipo_timemanager` tp ON t.`IdTipo_Auditoria` = tp.`id`
                                        INNER JOIN `Grupo_TimeManager` gp ON tp.`IdGrupo` = gp.`IdGrupo`
                                    WHERE 
                                        t.`Fecha_Registro` >= '$Fechaini' 
                                        AND t.`Fecha_Registro` <= '$Fechafin'
                                        AND (t.`IdCliente` = '$cliente' OR '$cliente' = '')
                                        AND (t.`Auditor` = '$usuario' OR '$usuario' = '')
                                        AND (t.`IdTipo_Auditoria` = '$actividad' OR '$actividad' = '')
                                        AND (gp.`IdGrupo` = '$grupo' OR '$grupo' = '')";
                                    //$query='SELECT  (SELECT u.`nombre` FROM `usuario_web` u WHERE u.`id`=t.`Auditor`)as Nombre,t.`Fecha_Registro`as Fecha, 
                                    //(SELECT tp.`Descripcion` FROM `tipo_timemanager` tp WHERE tp.`id`=t.`IdTipo_Auditoria`)as Grupo_Auditoria ,
                                    //(SELECT c.`nombre` FROM `cliente` c WHERE c.`id`=t.`IdCliente`)as Cliente,t.`Observaciones`,
                                    //(t.`H_Auditoria`+ t.`H_Supervision`+ t.`H_Planeacion`+ t.`H_SGC`)as Total_Horas FROM `timemanager` t , `tipo_timemanager` tp, `Grupo_TimeManager` gp 
                                    
                                    //WHERE t.`Fecha_Registro`  >= '$Fechaini' and t.`Fecha_Registro` <= '$Fechafin' and t.`IdTipo_Auditoria`=tp.`id`  and tp.`IdGrupo`= gp.`IdGrupo`';
                                                    
                                    
                                            echo '<tr>';
                                            //echo '<div><h2 class=card-title text-center><p><b>'.$queryp.'</b></p></h2></div>';
                                            echo Funciontabla::maketablesingle($queryp);
                                            echo '<tr>';
                        
                                        


                            }}
                              

                        @endphp
                        </tr> 
                    </thead>
                </table>  


            </div>
            
        </div>
    </div>
</div>
@endsection
