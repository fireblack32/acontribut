@php
 $idusuario=session()->get('usuario_id');
 //echo "super:".$hsupervisor." auditor:".$hauditoria." planeacion:".$hplaneacion." HSGC:".$hsgc." Obser:".$Observaciones;
                                    
{{
    $mytime = date('Y-m-d');
   
    
}}
@endphp
<head>
    <script language="JavaScript">



        function NumCheck(e, field) {
        
            key = e.keyCode ? e.keyCode : e.which;
        
            if (key === 8)
        
                return true;
        
            if (field.value !== "") {
        
                if ((field.value.indexOf(",")) > 0) {
        
                    if (key > 47 && key < 58) {
        
                        if (field.value === "")
        
                            return true;
        
                        regexp = /[0-9]{1,10}[\.][0-9]{1,3}$/;
        
                        regexp = /[0-9]{2}$/;
        
                        return !(regexp.test(field.value))
        
                    }
        
                }
        
            }
        
            if (key > 47 && key < 58) {
        
                if (field.value === "")
        
                    return true;
        
                regexp = /[0-9]{10}/;
        
                return !(regexp.test(field.value));
        
            }
        
            if (key === 46) {
        
                if (field.value === "")
        
                    return false;
        
                regexp = /^[0-9]+$/;
        
                return regexp.test(field.value);
        
         
        
            }
        
         
        
            return false;
        
        }
        
        </script>
 
    <script>
  
    function cuenta(){
        contenido_textarea = ""
        
        num_caracteres_permitidos = 200
       
       document.getElementById("form-general").caracteres.value=document.getElementById("form-general").Observaciones.value.length

       num_caracteres = document.getElementById("form-general").Observaciones.value.length
    
            if (num_caracteres <= num_caracteres_permitidos){
                //document.getElementById("form-general").texto.value = contenido_textarea
                
                contenido_textarea1=document.getElementById("form-general").Observaciones.value	
                document.getElementById("form-general").caracteres.classList.remove('bg-danger');
                
            }else{
                
                //contenido_textarea = document.getElementById("form-general").texto.value;
                document.getElementById("form-general").caracteres.classList.add('bg-danger');
                document.getElementById("form-general").Observaciones.value=contenido_textarea1
                
            }
        
    }
    </script>
     
</head>
<div class="form-group row">
    <label for="Auditor" class="col-lg-3 col-form-label requerido">ID Auditor</label>
    <div class="col-lg-8">
    <input type="text" name="Auditor" id="Auditor" class="form-control" value="{{ $idusuario }}" readonly required/>
    </div>
    <label for="usuario" class="col-lg-3 col-form-label requerido">Usuario</label>
    <div class="col-lg-8">
    <input type="text" name="usuario" id="usuario" class="form-control" value="{{old('nombre', $data->nombre ?? "$nombre")}}" readonly required/>
    </div>
    <label for="IdCliente" class="col-lg-3 col-form-label requerido">Cliente</label>
    <div class="col-lg-8">
        <select id="idcliente" name="idcliente" class="form-control" required>
            @foreach( $cliente as $key => $value )
            @if ($IdCliente==$value)
            <option value="{{$value}}" selected=selected>{{ $key}}</option>
            @else
            <option value="{{ $value }}">{{ $key }}</option>   
            @endif
            @endforeach 
     </select>
    </div>
    <label for="tipotm" class="col-lg-3 col-form-label requerido">Actividad</label>
    <div class="col-lg-8">
        <select id="idactividad" name="idactividad" class="form-control" required>
            @foreach( $actividad as $key => $value )
            @if ($IdTipo_Auditoria==$value)
            <option value="{{$value}}" selected=selected>{{ $key}}</option>
            @else
            <option value="{{ $value }}">{{ $key }}</option>   
            @endif
            @endforeach 
     </select>
    </div>
    <label for="H_Auditoria" class="col-lg-3 col-form-label requerido">H Auditoria: Eje(1.5)</label>
    <div class="col-lg-8">
    <input type="text" name="H_Auditoria" id="H_Auditoria" class="form-control" value="{{old('hauditoria', $hauditoria ?? '0')}}" />
    </div>
    <label for="H_Supervision" class="col-lg-3 col-form-label requerido">H Supervisión: Eje(1.5)</label>
    <div class="col-lg-8">
    <input type="text" name="H_Supervision" id="H_Supervision" class="form-control" value="{{old('hsupervisor', $hsupervisor ?? '0')}}" />
    </div>
    <label for="H_Planeacion" class="col-lg-3 col-form-label requerido">H Planeación: Eje(1.5)</label>
    <div class="col-lg-8">
    <input type="text" name="H_Planeacion" id="H_Planeacion" class="form-control" value="{{old('hplaneacion', $hplaneacion ?? '0')}}" />
    </div>
    <label for="H_SGC" class="col-lg-3 col-form-label requerido">	SGC: Eje (1.5)</label>
    <div class="col-lg-8">
    <input type="text" name="H_SGC" id="H_SGC" class="form-control" value="{{old('hsgc', $hsgc ?? '0')}}" />
    </div>
    <div class="form-group">
        <label class="col-lg-6 col-form-label d-inline requerido">Observaciones:</label>
    </div>
    <div class="col-lg-10 col-form-label">
        <textarea id="Observaciones"  onKeyDown="cuenta()" onKeyUp="cuenta()" class="col-sm-12 form-control" name="Observaciones" class="form-control" rows="3" placeholder="Enter ..." required>{{old('Observaciones', $Observaciones ?? '')}}</textarea>
    </div>
    <label for="caracteres" class="col-lg-3 col-form-label requerido">Max Cantidad de Caracteres</label>
    <div class="col-lg-8">
    <input type="text" name=caracteres id="caracteres" class="bg-success form-control" value="" readonly/>
    </div>
    <label for="fecha_ven" class="col-lg-3 col-form-label requerido">Fecha de Actividad</label>
    <div class="col-lg-8">
    <input type="date" name="Fecha_Registro" id="Fecha_Registro" class="form-control" value="{{old('Fecha_Registro', $data->Fecha_Registro ?? "$mytime")}}" required/>
    </div>
    <label for="idusuario_web" class="col-lg-3 col-form-label ">Año actividad</label>
    <div class="col-lg-8">
        <select id="A_Act" name="A_Act" class="form-control" >
            <option value="{{date("Y")-2}}">{{date("Y")-2}}</option>
            <option value="{{date("Y")-1}}">{{date("Y")-1}}</option>
            <option value="{{date("Y")}}" selected>{{date("Y")}}</option>
            <option value="{{date("Y")+1}}">{{date("Y")+1}}</option>
        </select>
    </div>
    <div class="custom-control custom-checkbox">
        <input class="custom-control-input " type="checkbox" id="seguro" name="seguro" value="1" required>
        <label for="seguro" class="custom-control-label "> Esta seguro que los datos son correctos:</label>
    </div>
    <div class="col-lg-8">
    <input type="hidden" name="id" value="{{old('id', $Id ?? '0')}}">
</div>

</div>