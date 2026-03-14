<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistema de Gestión | Seleccionar portal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset("Assets/lte/plugins/fontawesome-free/css/all.min.css") }}">
  <link rel="stylesheet" href="{{ asset("Assets/lte/dist/css/adminlte.min.css") }}">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box" style="width: 420px;">
  <div class="login-logo">
    <a href="{{ route('inicio') }}"><b>Sistema de</b> Gestion</a>
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Seleccione el portal al que desea ingresar</p>

      @if ($errors->any())
        <div class="alert alert-warning alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="mb-3 text-center text-muted small">
        <strong>{{ $azure_name }}</strong>
        @if($azure_email)
          <br><span>{{ $azure_email }}</span>
        @endif
      </div>

      <div class="d-flex flex-column gap-2">
        @if(in_array('contabilidad', $portales_permitidos, true))
          <a href="{{ route('portal.entrar', ['portal' => 'contabilidad']) }}" class="btn btn-primary btn-block btn-flat">
            <i class="fas fa-calculator mr-2"></i> Contabilidad
          </a>
        @endif
        @if(in_array('auditoria', $portales_permitidos, true))
          <a href="{{ route('portal.entrar', ['portal' => 'auditoria']) }}" class="btn btn-success btn-block btn-flat">
            <i class="fas fa-clipboard-check mr-2"></i> Auditoría
          </a>
        @endif
        @if(in_array('legales', $portales_permitidos, true))
          <a href="{{ route('portal.entrar', ['portal' => 'legales']) }}" class="btn btn-info btn-block btn-flat">
            <i class="fas fa-balance-scale mr-2"></i> Legales
          </a>
        @endif
      </div>

      <p class="mt-3 mb-0 text-center">
        <a href="{{ route('logout') }}" class="text-muted small">Cerrar sesión</a>
      </p>
    </div>
  </div>
</div>
<script src="{{ asset("Assets/lte/plugins/jquery/jquery.min.js") }}"></script>
<script src="{{ asset("Assets/lte/plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
<script src="{{ asset("Assets/lte/dist/js/adminlte.min.js") }}"></script>
<script>
(function () {
  console.log('%c========== DEBUG Azure + Bases de datos ==========', 'font-size:14px; font-weight:bold');
  console.log('%c1. Respuesta de Azure (token endpoint) - claves recibidas:', 'font-weight:bold; color:#0066cc');
  console.log('   Código HTTP:', @json(session('debug_token_response_code')));
  console.log('   Claves en la respuesta:', @json(session('debug_token_keys')));
  console.log('%c2. Azure id_token - claims (email, nombre, etc.):', 'font-weight:bold; color:#0066cc');
  console.log(@json(session('debug_azure_claims')));
  console.log('%c3. Bases de datos - portales donde existe el usuario:', 'font-weight:bold; color:#008800');
  console.log(@json(session('debug_portales_result')));
  console.log('%c==================================================', 'font-size:14px; font-weight:bold');
})();
</script>
</body>
</html>
