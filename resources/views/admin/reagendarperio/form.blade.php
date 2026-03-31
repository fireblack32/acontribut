@php
    {{

  $ano=date ("Y");
  $anosig=$ano+1;
  $anopre=$ano-1;


    }}
@endphp
<label for="datey" class="col-lg-3 col-form-label requerido">Año o periodo</label>
    <div class="col-lg-8">
        <select id="datey" name="datey" class="form-control">
            <option value="{{ $anopre }}">{{ $anopre }}</option>
            <option value="{{ $ano }}">{{ $ano }}</option>
            <option value="{{ $anosig }}">{{ $anosig }}</option>
        </select>
</div>