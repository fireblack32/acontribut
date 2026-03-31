@php
{{
$usuario='';  
$clave=''; 
$segclave='';
$pregunta='';
$respuesta='';
$pregunta2='';
$respuesta2='';
$pregunta3='';
$respuesta3='';
$correoaso='';
$observaciones='';

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

<label for="tipo" class="col-lg-3 col-form-label requerido">Plataforma</label>
    <div class="col-lg-8">
        <select id="tipo" name="tipo" class="form-control" required>
            <option></option>    
            @foreach( $tipo as $key => $value )
                <option value="{{ $value }}">{{ $key }}</option>
            @endforeach
     </select>
    </div>
    <label for="usuario" class="col-lg-3 col-form-label requerido">Usuario</label>
    <div class="col-lg-8">
    <input type="text" name="usuario" id="usuario" class="form-control" value= "{{$usuario}}" required/>
    </div>
    <label for="clave" class="col-lg-3 col-form-label requerido">Clave</label>
    <div class="col-lg-8">
    <input type="text" name="clave" id="clave" class="form-control" value= "{{$clave}}" required/>
    </div>
    <label for="segclave" class="col-lg-3 col-form-label requerido">Segunda Clave</label>
    <div class="col-lg-8">
    <input type="text" name="segclave" id="segclave" class="form-control" value= "{{$segclave}}" />
    </div>
    <label for="pregunta" class="col-lg-3 col-form-label requerido">Pregunta</label>
    <div class="col-lg-8">
    <input type="text" name="pregunta" id="pregunta" class="form-control" value= "{{$pregunta}}" />
    </div>
    <label for="respuesta" class="col-lg-3 col-form-label requerido">Respuesta</label>
    <div class="col-lg-8">
    <input type="text" name="respuesta" id="respuesta" class="form-control" value= "{{$respuesta}}" />
    </div>
    <label for="pregunta2" class="col-lg-3 col-form-label requerido">Pregunta dos</label>
    <div class="col-lg-8">
    <input type="text" name="pregunta2" id="pregunta2" class="form-control" value= "{{$pregunta2}}" />
    </div>
    <label for="respuesta2" class="col-lg-3 col-form-label requerido">Respuesta dos</label>
    <div class="col-lg-8">
    <input type="text" name="respuesta2" id="respuesta2" class="form-control" value= "{{$respuesta2}}" />
    </div>
    <label for="pregunta3" class="col-lg-3 col-form-label requerido">Pregunta tres</label>
    <div class="col-lg-8">
    <input type="text" name="pregunta3" id="pregunta3" class="form-control" value= "{{$pregunta3}}" />
    </div>
    <label for="respuesta3" class="col-lg-3 col-form-label requerido">Respuesta tres</label>
    <div class="col-lg-8">
    <input type="text" name="respuesta3" id="respuesta3" class="form-control" value= "{{$respuesta3}}" />
    </div>
    <label for="correoaso" class="col-lg-3 col-form-label requerido">Correo Asociado</label>
    <div class="col-lg-8">
    <input type="email" name="correoaso" id="correoaso" class="form-control" value= "{{$correoaso}}" />
    </div>
    <label for="observaciones" class="col-lg-3 col-form-label requerido">Observaciones</label>
    <div class="col-lg-8">
    <input type="text" name="observaciones" id="observaciones" class="form-control" value= "{{$observaciones}}" />
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
   
    