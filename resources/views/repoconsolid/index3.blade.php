@php
$ruta_final="informe_excel(".date('Y-m-d_H:i:s').").xls";
$excelfile=$ruta_final;
@header('Content-type: application/octet-stream'); 
@header('Content-disposition: attachment; filename='.$excelfile);

$queryp = "SELECT  
    t.`id` AS IDR,
    t.`Auditor` AS IDA,
    (SELECT u.`nombre` FROM `usuario_web` u WHERE u.`id` = t.`Auditor`) AS Nombre,
    t.`Fecha_Registro` AS Fecha,
    t.`IdTipo_Auditoria` AS IDT,
    (SELECT tp.`Descripcion` FROM `tipo_timemanager` tp WHERE tp.`id` = t.`IdTipo_Auditoria`) AS Actividad,
    (SELECT tp.`Descripcion` FROM `tipo_timemanager` tp WHERE tp.`id` = t.`IdTipo_Auditoria`) AS Auditoria,
    (SELECT g.`Descripcion` FROM `Grupo_TimeManager` g 
     INNER JOIN `tipo_timemanager` tp ON g.`IdGrupo` = tp.`IdGrupo` 
     WHERE tp.`id` = t.`IdTipo_Auditoria`) AS Grupo,
    t.`IdCliente` AS NIT,
    (SELECT c.`nombre` FROM `cliente` c WHERE c.`id` = t.`IdCliente`) AS Cliente,
    `H_Auditoria`, `H_Supervision`, `H_Planeacion`, `H_SGC`, `A_Perfil`,
    `VT_Junior` AS VP_Junior, `VT_Senior` AS VP_Senior, `VT_Director` AS VP_Director,
    `VT_Socio` AS VP_Socio, `VT_Mensual_Cliente` AS VT_anual_Cliente, `VT_Usuario_H` AS Horas_Pactadas, 
    `VT_Usuario_T`, `CapacidadAUD`, `A_Act` AS A_Actividad, `Observaciones`,
    (t.`H_Auditoria` + t.`H_Supervision` + t.`H_Planeacion` + t.`H_SGC`) AS Total_Horas,
    TRUNCATE((`VT_Mensual_Cliente` / `VT_Usuario_H`), 2) AS Tarifa_Estandar_Hora,
    TRUNCATE(((`VT_Mensual_Cliente` / `VT_Usuario_H`) * (`H_Auditoria` + `H_Supervision` + `H_Planeacion` + `H_SGC`)), 2) AS Ingresos,
    TRUNCATE(((`H_Auditoria` + `H_Supervision` + `H_Planeacion` + `H_SGC`) * (`VT_Usuario_T` / `CapacidadAUD`)), 2) AS Costos,
    TRUNCATE((((`VT_Mensual_Cliente` / `VT_Usuario_H`) * (`H_Auditoria` + `H_Supervision` + `H_Planeacion` + `H_SGC`)) - 
             ((`H_Auditoria` + `H_Supervision` + `H_Planeacion` + `H_SGC`) * (`VT_Usuario_T` / `CapacidadAUD`))), 2) AS Utilidad 
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

     		    echo '<tr>';
               	    //echo '<div><h2 class=card-title text-center><p><b>'.$queryp.'</b></p></h2></div>';
                    echo Funciontabla::maketablesingle($queryp);
                    echo '<tr>';
   @endphp
