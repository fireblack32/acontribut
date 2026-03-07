@php

                                    
{{
    $usuario_id=session()->get('usuario_id');
    $sucursal='';
    $respoiva='';
    $exportador='';
    $auditoria='';
    $contratesp='';
    $revfis='';
    $conrevfis='';
    $ultimedit='';
    $query='SELECT `id`,`nombre`, `direccion`, `tel_fijo`, `tel_movil`, `fax`, `pbx`, `email`, `representante_legal`, `id_representante_legal`, `tipo_sociedad_idtipo_sociedad`, `fecha_constitucion`, `fecha_expiracion`, `persona_contacto` FROM `cliente` WHERE `id`='.$cliente.'';
    //echo $query;                                               
    $database =Config::get('database.connections.'.Config::get('database.default'));
    $database_name=$database['database'];
    $database_host = $database['host'];
    $database_password =  $database['password'];
    $database_user =  $database['username'];
    $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
    $result2=mysqli_query($conn,$query);
    while($row=mysqli_fetch_array($result2)){
    $id=$row["id"];
    $nombre=$row["nombre"];
    //echo $nombre;  
    $direccion=$row["direccion"];
    $tel_fijo=$row["tel_fijo"];
    $tel_movil=$row["tel_movil"];
    $email=$row["email"];
    $persona_contacto=$row["persona_contacto"];
    $id_representante_legal=$row["id_representante_legal"];
    $representante_legal=$row["representante_legal"];
    $fecha_expiracion=$row["fecha_expiracion"];
    $fecha_constitucion=$row["fecha_constitucion"];
    $idtipo_sociedad=$row["tipo_sociedad_idtipo_sociedad"];
    //echo "La persona de contacto es:".$persona_contacto;
    }
    $query2='SELECT `Grupo_NIIF`, `Cap_Ext`, `Act_Eco`, `Sup_Rep_Leg`, `IdSup_Rep_Leg`, `Propuesta`, 
    `Rev_Fiscal`, `Nom_Revisor`, `Id_Revisor`, `TP_Revisor`, `Sup_Nom_Revisor`, `IdSup_Revisor`, `TPSup_Revisor`, `Contac_equi_Rev`,`fecharenov`,`idtipo_sociedad`,`sucursal`,`respoiva`,`exportador`,`auditoria`,`contratesp`,`revfis`,`conrevfis`,`ultimedit` FROM `datos_actacliente` WHERE `Nit`='.$cliente.'';
    //echo $query; 
    $conn = mysqli_connect($database_host,$database_user,$database_password,$database_name);
    $result2=mysqli_query($conn,$query2);
    while($row=mysqli_fetch_array($result2)){

        $Grupo_NIIF=$row["Grupo_NIIF"];
        $Cap_Ext=$row["Cap_Ext"]; 
        $Act_Eco=$row["Act_Eco"];
       // echo "Actividade camara:".$Act_Eco;
        $Sup_Rep_Leg=$row["Sup_Rep_Leg"];
        $IdSup_Rep_Leg=$row["IdSup_Rep_Leg"];
        $Propuesta=$row["Propuesta"];
        $Rev_Fiscal=$row["Rev_Fiscal"];
        $Nom_Revisor=$row["Nom_Revisor"];
        $Id_Revisor=$row["Id_Revisor"];
        $TP_Revisor=$row["TP_Revisor"];
        $Sup_Nom_Revisor=$row["Sup_Nom_Revisor"];
        $IdSup_Revisor=$row["IdSup_Revisor"];
        $TPSup_Revisor=$row["TPSup_Revisor"];
        $Contac_equi_Rev=$row["Contac_equi_Rev"];
        $fecharenov=$row["fecharenov"];
        
        $sucursal=$row["sucursal"];
        $respoiva=$row["respoiva"];
        $exportador=$row["exportador"];
        $auditoria=$row["auditoria"];
        $contratesp=$row["contratesp"];
        $revfis=$row["revfis"];
        $conrevfis=$row["conrevfis"];
        $ultimedit=$row["ultimedit"];
        
    }
    
}}
@endphp


<div class="form-group row">
    
    <label for="fecha_act" class="col-lg-3 col-form-label requerido">Fecha de Actualización</label>
    <div class="col-lg-8">
    <input type="date" name="fecha_act" id="fecha_act" class="form-control" value="{{old('fecha_act', $fecha_expiracion ?? '')}}" readonly/>
     </div>
    <label for="id" class="col-lg-3 col-form-label requerido">NIT</label>
    <div class="col-lg-8">
    <input type="text" name="id" id="id" class="form-control" value="{{old('id', $id ?? '')}}" readonly/>
    </div>
    <label for="fecha_cons" class="col-lg-3 col-form-label requerido">Fecha de Constitución</label>
    <div class="col-lg-8">
    <input type="date" name="fecha_cons" id="fecha_cons" class="form-control" value="{{old('fecha_cons', $fecha_constitucion ?? '')}}" readonly/>
     </div>
    <label for="nombre" class="col-lg-3 col-form-label requerido">Nombre</label>
    <div class="col-lg-8">
    <input type="text" name="nombre" id="nombre" class="form-control" value="{{old('nombre', $nombre ?? '')}}" readonly/>
    </div>
    <label for="direccion" class="col-lg-3 col-form-label requerido">Dirección</label>
    <div class="col-lg-8">
    <input type="text" name="direccion" id="direccion" class="form-control" value="{{old('direccion', $direccion ?? '')}}" readonly/>
    </div>
    <label for="tel_fijo" class="col-lg-3 col-form-label ">Telefono</label>
    <div class="col-lg-8">
    <input type="text" name="tel_fijo" id="tel_fijo" class="form-control" value="{{old('tel_fijo', $tel_fijo ?? '')}}" readonly/>
    </div>
    <label for="tel_movil" class="col-lg-3 col-form-label ">Celular</label>
    <div class="col-lg-8">
    <input type="text" name="tel_movil" id="tel_movil" class="form-control" value="{{old('tel_movil', $tel_movil ?? '')}}" readonly/>
    </div>
    <label for="fax" class="col-lg-3 col-form-label ">Grupo NIIF</label>
    <div class="col-lg-8">
    <input type="text" name="gruniif" id="gruniif" class="form-control" value="{{old('gruniif', $Grupo_NIIF ?? '')}}" readonly/>
    </div>
    <label for="email" class="col-lg-3 col-form-label requerido">E Mail</label>
    <div class="col-lg-8">
    <input type="email" name="email" id="email" class="form-control" value="{{old('email', $email ?? '')}}" readonly/>
    </div>
    <label for="idtipo_sociedad" class="col-lg-3 col-form-label requerido">Tipo de Sociedad</label>
    <div class="col-lg-8">
        <select id="tipo" name="tipo" class="form-control" readonly>
            <option></option>   
            @foreach( $tipo as $key => $value )
            @if ($idtipo_sociedad==$value)
            <option value="{{ $value }}" selected=selected>{{ $key }}</option>
            @else
            <option value="{{ $value }}">{{ $key }}</option>   
            @endif
            @endforeach 
           
        </select>
    </div>
    <label for="sucursal" class="col-lg-3 col-form-label ">Sucursal Extranjera</label>
    <div class="col-lg-8">
        <select id="sucursal" name="sucursal" class="form-control" readonly>
            <option></option>   
            @foreach( $sino as $key => $value )
            @if ($sucursal==$value)
            <option value="{{ $value }}" selected=selected>{{ $key }}</option>
            @else
            <option value="{{ $value }}">{{ $key }}</option>   
            @endif
            @endforeach 
           
        </select>
    </div>
    <label for="capitalext" class="col-lg-3 col-form-label requerido">Capital Extrangero</label>
    <div class="col-lg-8">
    <input type="text" name="capitalext" id="capitalext" class="form-control" value="{{old('capitalext', $Cap_Ext ?? '')}}" readonly/>
    </div>
    <label for="respoiva" class="col-lg-3 col-form-label ">Resposable de IVA</label>
    <div class="col-lg-8">
        <select id="respoiva" name="respoiva" class="form-control" readonly>
            <option></option>   
            @foreach( $sino as $key => $value )
            @if ($respoiva==$value)
            <option value="{{ $value }}" selected=selected>{{ $key }}</option>
            @else
            <option value="{{ $value }}">{{ $key }}</option>   
            @endif
            @endforeach 
           
        </select>
    </div>
    </div>
    <label for="persona_contacto" class="col-lg-3 col-form-label requerido">Persona de Contacto</label>
    <div class="col-lg-8">
    <input type="text" name="persona_contacto" id="persona_contacto" class="form-control" value="{{old('persona_contacto', $persona_contacto ?? '')}}" readonly/>
    </div>
    <label for="cel_contacto" class="col-lg-3 col-form-label requerido">Celular contacto</label>
    <div class="col-lg-8">
     <input type="text" name="cel_contacto" id="cel_contacto" class="form-control" value="{{old('cel_contacto', $tel_movil ?? '')}}" readonly/>
    </div>
    <label for="tel_contacto" class="col-lg-3 col-form-label requerido">Telefono contacto</label>
    <div class="col-lg-8">
     <input type="text" name="tel_contacto" id="tel_contacto" class="form-control" value="{{old('tel_contacto', $tel_fijo ?? '')}}" readonly/>
    </div>
    <label for="exportador" class="col-lg-3 col-form-label ">Es exportador</label>
    <div class="col-lg-8">
        <select id="exportador" name="exportador" class="form-control" readonly>
            <option></option>   
            @foreach( $sino as $key => $value )
            @if ($exportador==$value)
            <option value="{{ $value }}" selected=selected>{{ $key }}</option>
            @else
            <option value="{{ $value }}">{{ $key }}</option>   
            @endif
            @endforeach 
           
        </select>
    </div>
    <label for="auditoria" class="col-lg-3 col-form-label ">Activo Auditoria</label>
    <div class="col-lg-8">
        <select id="auditoria" name="auditoria" class="form-control" readonly>
            <option></option>   
            @foreach( $sino as $key => $value )
            @if ($auditoria==$value)
            <option value="{{ $value }}" selected=selected>{{ $key }}</option>
            @else
            <option value="{{ $value }}">{{ $key }}</option>   
            @endif
            @endforeach 
           
        </select>
    </div>

    <label for="capitalext" class="col-lg-3 col-form-label "></label>
    <div class="col-lg-8">
    </div>
    
    <label for="capitalext" class="col-lg-3 col-form-label requerido">ACTIVIDAD (ES) ECONÓMICA (S) SEGÚN RUT:</label>
    <div>
    <tr>
        @php
        
        {{
                    //echo $cliente;
                    $querypre='SELECT a.`Actividad`, `Codigo`, b.`Descripcion`, b.`Tarifa_1`, b.`Tarifa_2`, b.`Tarifa_3`,a.`Orden` FROM `actividades_cliente` a,`actividades_economicas` b WHERE a.`cliente_idcliente`='.$cliente.' AND b.`Id`=a.`Actividad`';                                 
                      echo '<tr>';
                      //echo $querypre;
                      //echo '<div><h2 class=card-title text-center><p><b>tabla:'.$table.' el query es: '.$queryp.'</b></p></h2></div>';
                      echo Funciontabla::maketablesintitulo($querypre);
                      echo '<tr>';
        }}
        @endphp
    </tr> 
    </div>

    <label for="actecon" class="col-lg-3 col-form-label requerido">ACTIVIDAD ECONÓMICA SEGÚN CÁMARA DE COMERCIO:</label>
    <div class="col-lg-8">
        <input type="text" name="actecon" id="actecon" class="form-control" value="{{old('tel_contacto', $Act_Eco ?? '')}}" readonly/>
    </div>
    <label for="contratesp" class="col-lg-3 col-form-label ">CONTRATOS ESPECIALES:</label>
    <div class="col-lg-8">
        <select id="contratesp" name="contratesp" class="form-control" readonly>
            <option></option>   
            @foreach( $sino as $key => $value )
            @if ($contratesp==$value)
            <option value="{{ $value }}" selected=selected>{{ $key }}</option>
            @else
            <option value="{{ $value }}">{{ $key }}</option>   
            @endif
            @endforeach 
           
        </select>
    </div>
    <label for="fecharenov" class="col-lg-3 col-form-label requerido">FECHA DE RENOVACIÓN CÁMARA DE COMERCIO:</label>
    <div class="col-lg-8">
    <input type="date" name="fecharenov" id="fecharenov" class="form-control" value="{{old('fecharenov', $fecharenov ?? '')}}" readonly/>
     </div>

     <label for="replegal" class="col-lg-3 col-form-label requerido">REPRESENTANTE LEGAL O APODERADO:</label>
     <div class="col-lg-8">
     <input type="text" name="replegal" id="replegal" class="form-control" value="{{old('replegal', $representante_legal ?? '')}}" readonly/>
     </div>
     <label for="idreplegal" class="col-lg-3 col-form-label requerido">ID REPRESENTANTE LEGAL O APODERADO:</label>
     <div class="col-lg-8">
     <input type="text" name="idreplegal" id="idreplegal" class="form-control" value="{{old('idreplegal', $id_representante_legal ?? '')}}" readonly/>
     </div>
     
     <label for="replegalsup" class="col-lg-3 col-form-label requerido">REPRESENTANTE LEGAL SUPLENTE:</label>
     <div class="col-lg-8">
     <input type="text" name="replegalsup" id="replegalsup" class="form-control" value="{{old('replegalsup', $Sup_Rep_Leg ?? '')}}" readonly/>
     </div>
     <label for="idreplegalsup" class="col-lg-3 col-form-label requerido">ID REPRESENTANTE LEGAL SUPLENTE:</label>
     <div class="col-lg-8">
     <input type="text" name="idreplegalsup" id="idreplegalsup" class="form-control" value="{{old('idreplegalsup', $IdSup_Rep_Leg ?? '')}}" readonly/>
     </div>
     <label for="propuestaact" class="col-lg-3 col-form-label requerido">PROPUESTA ACTUALIZADA:</label>
     <div class="col-lg-8">
     <input type="text" name="propuestaact" id="propuestaact" class="form-control" value="{{old('propuestaact', $Propuesta ?? '')}}" readonly/>
     </div>
     <label for="capitalext" class="col-lg-3 col-form-label requerido">LISTA DE ACCIONISTAS:</label>
     <div>
        <tr>
            @php
            
            {{
                        //echo $cliente;
                        $querypre='SELECT r.`cliente_idcliente` as Cliente,(SELECT i.`nombre` FROM `cliente` i WHERE i.`id`=r.`cliente_idcliente`)as Nombre,`Porc_Parti`as Participacion,`documento`,concat(r.`nombres`," ",r.`apellidos`)as BENEFICIARIOS_FINALES,`Pais` FROM `representante_cliente` r WHERE `cliente_idcliente`='.$cliente.'';                                 
                        echo '<tr>';
                        //echo $querypre;
                        //echo '<div><h2 class=card-title text-center><p><b>tabla:'.$table.' el query es: '.$queryp.'</b></p></h2></div>';
                        echo Funciontabla::maketablesintitulo($querypre);
                        echo '<tr>';
        }}
        @endphp
        </tr> 
     </div>
     <label for="capitalext" class="col-lg-16 col-form-label requerido">Relación con otros clientes y casos en que aun cuando haya familiaridad o afinidad no se debe filtrar información:</label>
     <div>
        <tr>
            @php
            
            {{
                        //echo $cliente;
                        $querypre='SELECT (SELECT c.`nombre` FROM `cliente`c WHERE c.`id`=`relacionado`)as Nombre, IF(cr.`Autoriza`=1, "SI", "NO")as Autoriza FROM `clientes_has_relacion` cr WHERE cr.`cliente_idcliente`='.$cliente.'';                                 
                        echo '<tr>';
                        //echo $querypre;
                        //echo '<div><h2 class=card-title text-center><p><b>tabla:'.$table.' el query es: '.$queryp.'</b></p></h2></div>';
                        echo Funciontabla::maketablesintitulo($querypre);
                        echo '<tr>';
        }}
        @endphp
        </tr> 
     </div>
    <div class="col-lg-8">
    <label for="revfis" class="col-lg-3 col-form-label ">REVISORÍA FISCAL:</label>
    <div class="col-lg-8">
        <select id="revfis" name="revfis" class="form-control" >
            <option></option>   
            @foreach( $sino as $key => $value )
            @if ($revfis==$value)
            <option value="{{ $value }}" selected=selected>{{ $key }}</option>
            @else
            <option value="{{ $value }}">{{ $key }}</option>   
            @endif
            @endforeach 
           
        </select>
    </div>
    <label for="revfiscal" class="col-lg-4 col-form-label requerido">a.Nombre del revisor fiscal principal </label>
     <div class="col-lg-4">
     <input type="text" name="revfiscal" id="revfiscal" class="form-control" value="{{old('revfiscal', $Nom_Revisor ?? '')}}" />
     </div>
     <label for="idrevfiscal" class="col-lg-5 col-form-label requerido">a.1. Identificación del revisor fiscal principal </label>
     <div class="col-lg-4">
     <input type="text" name="idrevfiscal" id="idrevfiscal" class="form-control" value="{{old('idrevfiscal', $Id_Revisor ?? '')}}" />
     </div>
     <label for="tarrevfiscal" class="col-lg-5 col-form-label requerido">a.2. Tarj Prof del revisor fiscal principal </label>
     <div class="col-lg-4">
     <input type="text" name="tarrevfiscal" id="tarrevfiscal" class="form-control" value="{{old('tarrevfiscal', $TP_Revisor ?? '')}}" />
     </div>

     <label for="nomrevfiscalsup" class="col-lg-4 col-form-label requerido">b.Nombre del revisor fiscal suplente </label>
     <div class="col-lg-4">
     <input type="text" name="nomrevfiscalsup" id="nomrevfiscalsup" class="form-control" value="{{old('revfiscal', $Sup_Nom_Revisor ?? '')}}" />
     </div>
     <label for="idrevfiscalsup" class="col-lg-5 col-form-label requerido">b.1. Identificación del revisor fiscal suplente </label>
     <div class="col-lg-4">
     <input type="text" name="idrevfiscalsup" id="idrevfiscalsup" class="form-control" value="{{old('idrevfiscal', $IdSup_Revisor ?? '')}}" />
     </div>
     <label for="tarrevfiscalsup" class="col-lg-5 col-form-label requerido">b.2. Tarj Prof del revisor fiscal suplente </label>
     <div class="col-lg-4">
     <input type="text" name="tarrevfiscalsup" id="tarrevfiscalsup" class="form-control" value="{{old('tarrevfiscal', $TPSup_Revisor ?? '')}}" />
     </div>
     <label for="conrevfis" class="col-lg-5 col-form-label ">c. Contactos del equipo de revisoría fiscal:</label>
     <div class="col-lg-8">
        <select id="conrevfis" name="conrevfis" class="form-control" >
            <option></option>   
            @foreach( $sino as $key => $value )
            @if ($conrevfis==$value)
            <option value="{{ $value }}" selected=selected>{{ $key }}</option>
            @else
            <option value="{{ $value }}">{{ $key }}</option>   
            @endif
            @endforeach 
           
        </select>
     </div>

     <label for="capitalext" class="col-lg-16 col-form-label requerido">PERSONAS DE CONTACTO:</label>
     <div>
        <tr>
            @php
            
            {{
                        //echo $cliente;
                        $querypre='SELECT `Nombre`, `Telefono`, `Cargo`, `Observaciones`,`id` FROM `lista_contactos` WHERE `cliente_idcliente`='.$cliente.'';                                 
                        echo '<tr>';
                        //echo $querypre;
                        //echo '<div><h2 class=card-title text-center><p><b>tabla:'.$table.' el query es: '.$queryp.'</b></p></h2></div>';
                        echo Funciontabla::maketablesintitulo($querypre);
                        echo '<tr>';
        }}
        
        @endphp
        </tr> 
     </div>

     <label for="municipios" class="col-lg-16 col-form-label requerido">INGRESOS OTROS MUNICIPIOS</label>
     <div>
        <tr>
            @php
            
            {{
                        //echo $cliente;
                        $querypre='SELECT  cm.`idcliente`,(SELECT c.`nombre` FROM `cliente` c WHERE c.`id`=cm.`idcliente`) AS NomCliente ,cm.`idmunicipio`,(SELECT CONCAT(m.`Municipio`, m.`Departamento`) FROM `tipo_municipio` m WHERE m.`id_tipo_municipio`=cm.`idmunicipio`)as Municipio,cm.`id` FROM `cliente_has_municipio` cm where  cm.`idcliente`='.$cliente.'';                                 
                        echo '<tr>';
                        //echo $querypre;
                        //echo '<div><h2 class=card-title text-center><p><b>tabla:'.$table.' el query es: '.$queryp.'</b></p></h2></div>';
                        echo Funciontabla::maketablesintitulo($querypre);
                        echo '<tr>';
        }}
        @endphp
        </tr> 
     </div>

     <label for="revfis" class="col-lg-16 col-form-label ">TIENE INGRESOS DIFERIDOS:</label>
    <div class="col-lg-8">
        <select id="revfis" name="revfis" class="form-control" >
            <option></option>   
            @foreach( $sino as $key => $value )
            @if ($revfis==$value)
            <option value="{{ $value }}" selected=selected>{{ $key }}</option>
            @else
            <option value="{{ $value }}">{{ $key }}</option>   
            @endif
            @endforeach 
           
        </select>
    </div>
    <label for="revfis" class="col-lg-16 col-form-label ">RETENCIONES A TÍTULO DE RENTA DE OTROS PAÍSES:</label>
    <div class="col-lg-8">
        <select id="revfis" name="revfis" class="form-control" >
            <option></option>   
            @foreach( $sino as $key => $value )
            @if ($revfis==$value)
            <option value="{{ $value }}" selected=selected>{{ $key }}</option>
            @else
            <option value="{{ $value }}">{{ $key }}</option>   
            @endif
            @endforeach 
           
        </select>
    </div>
    <label for="revfis" class="col-lg-16 col-form-label ">EXPLICACIÓN DETALLADA DE LOS DIFERENTES TIPOS DE DOCUMENTOS:</label>
    <div class="form-group">
        <label for="Notas">Facturas electrónicas</label>
        <textarea name="facturas" rows="2" cols="20" class="form-control" placeholder="Facturas electrónicas..."></textarea>
    </div>
    <div class="form-group">
        <label for="Notas"> DS</label>
        <textarea name="ds" rows="2" cols="20" class="form-control" placeholder=" DS..."></textarea>
    </div>
    <div class="form-group">
        <label for="Notas"> Equel</label>
        <textarea name="equel" rows="2" cols="20" class="form-control" placeholder="Equel..."></textarea>
    </div>
    <div class="form-group">
        <label for="Notas"> Notas débito y crédito</label>
        <textarea name="notasdyc" rows="2" cols="20" class="form-control" placeholder="Notas débito y crédito..."></textarea>
    </div>
    <div class="form-group">
        <label for="Notas"> Documentos de nómina</label>
        <textarea name="nomina" rows="2" cols="20" class="form-control" placeholder="Documentos de nómina..."></textarea>
    </div>
    <div class="form-group">
        <label for="Notas"> Documentos de cruce</label>
        <textarea name="dcruce" rows="2" cols="20" class="form-control" placeholder="Documentos de cruce..."></textarea>
    </div>
    
    <label for="revfis" class="col-lg-16 col-form-label ">DETALLE DE:</label>
    <div class="form-group">
        <label for="Notas">Manejo y control de pagos en efectivo.</label>
        <textarea name="manefectivo" rows="2" cols="20" class="form-control" placeholder="Manejo y control de pagos en efectivo...."></textarea>
    </div>
    <div class="form-group">
        <label for="Notas">Procedimiento para emisión de certificados bimestrales de Ica.</label>
        <textarea name="manejica" rows="2" cols="20" class="form-control" placeholder="Procedimiento para emisión de certificados bimestrales de Ica...."></textarea>
    </div>
    <div class="form-group">
        <label for="Notas">Procedimiento y formatos para solicitud de certificados de retención en la fuente anuales.</label>
        <textarea name="maneceret" rows="2" cols="20" class="form-control" placeholder="Procedimiento y formatos para solicitud de certificados de retención en la fuente anuales...."></textarea>
    </div>
    <div class="form-group">
        <label for="Notas">Procedimientos y momentos en que se solicitan los avalúos técnicos.</label>
        <textarea name="proceavaluos" rows="2" cols="20" class="form-control" placeholder="Procedimientos y momentos en que se solicitan los avalúos técnicos..."></textarea>
    </div>

    <label for="revfis" class="col-lg-16 col-form-label ">ASUNTOS PENDIENTES POR DEFINICIÓN (CON DESCRIPCIÓN ESPECÍFICA Y SOPORTES) DE:</label>
    <div class="form-group">
        <label for="Notas">Cliente</label>
        <textarea name="pencliente" rows="2" cols="20" class="form-control" placeholder="Pendientes del cliente..."></textarea>
    </div>
    <div class="form-group">
        <label for="Notas">Contabilidad</label>
        <textarea name="penContabilidad" rows="2" cols="20" class="form-control" placeholder="Pendientes de Contabilidad..."></textarea>
    </div>
    <div class="form-group">
        <label for="Notas">Legales</label>
        <textarea name="penlegales" rows="2" cols="20" class="form-control" placeholder="Pendientes de Legales..."></textarea>
    </div>
    <div class="form-group">
        <label for="Notas"> Dian</label>
        <textarea name="pendian" rows="2" cols="20" class="form-control" placeholder="Pendientes  Dian..."></textarea>
    </div>
    <div class="form-group">
        <label for="Notas">Distrito o municipios</label>
        <textarea name="pendistritos" rows="2" cols="20" class="form-control" placeholder="Pendientes Distrito o municipios..."></textarea>
    </div>
    <div class="form-group">
        <label for="Notas">Supersociedades</label>
        <textarea name="pendsupersociedades" rows="2" cols="20" class="form-control" placeholder="Pendientes Supersociedades..."></textarea>
    </div>

    <div class="form-group">
        <label for="Notas">Abogados</label>
        <textarea name="pendabogados" rows="2" cols="20" class="form-control" placeholder="Pendientes Abogados..."></textarea>
    </div>
    <div class="form-group">
        <label for="Notas">PQRS</label>
        <textarea name="pendpqrs" rows="2" cols="20" class="form-control" placeholder="Pendientes PQRS..."></textarea>
    </div>
    <div class="form-group">
        <label for="Notas">Auditoria</label>
        <textarea name="pendauditoria" rows="2" cols="20" class="form-control" placeholder="Pendientes Auditoria..."></textarea>
    </div>
    <div class="form-group">
        <label for="Notas">Otros</label>
        <textarea name="pendotros" rows="2" cols="20" class="form-control" placeholder="Pendientes Otros..."></textarea>
    </div>

     <label for="ultimedit" class="col-lg-5 col-form-label requerido">Ultimo Editor </label>
     <div class="col-lg-4">
     <input type="text" name="ultimedit" id="ultimedit" class="form-control" value="{{old('ultimedit', $ultimedit ?? '')}}" readonly/>
     </div>
     
    <div class="col-lg-8">
    <input type="hidden" name="usuario_id" id="usuario_id" class="form-control" value="{{old('usuario_id', $usuario_id ?? '')}}" readonly/>
    </div>
    
</div>