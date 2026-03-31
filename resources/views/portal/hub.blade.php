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
  <style>
    :root {
      --portal-red: #c62828;
      --portal-blue: #0d3b66;
      --portal-blue-bright: #1565c0;
    }
    body.hold-transition.login-page.portal-auth-page {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1.5rem 1rem 2rem;
      background-color: #f4efe7;
      background-image:
        radial-gradient(ellipse 85% 60% at 0% 5%, rgba(198, 40, 40, 0.16), transparent 52%),
        radial-gradient(ellipse 75% 55% at 100% 8%, rgba(13, 59, 102, 0.14), transparent 48%),
        radial-gradient(ellipse 70% 50% at 100% 92%, rgba(21, 101, 192, 0.12), transparent 50%),
        radial-gradient(ellipse 65% 48% at 0% 95%, rgba(198, 40, 40, 0.1), transparent 48%),
        radial-gradient(ellipse 50% 40% at 50% 50%, rgba(255, 255, 255, 0.55), transparent 70%),
        linear-gradient(118deg,
          #faf6f1 0%,
          #f8f0eb 18%,
          #f3f6fb 52%,
          #eef2f9 78%,
          #ebeff6 100%);
    }
    .portal-auth-page .login-box {
      width: 100%;
      max-width: 600px;
      margin: 0 auto;
    }
    .portal-auth-card {
      border: none;
      border-radius: 22px;
      overflow: hidden;
      background: #f4efe7;
      box-shadow:
        0 22px 56px rgba(13, 59, 102, 0.16),
        0 8px 22px rgba(198, 40, 40, 0.12),
        inset 0 1px 0 rgba(255, 255, 255, 0.95);
    }
    .portal-auth-card > .portal-logo-in-card {
      width: 100%;
      text-align: left;
      margin: 0px 0rem 2.5rem;
      line-height: 0;
    }
    .portal-auth-card > .portal-logo-in-card img {
      width: 100%;
      height: auto;
      display: block;
      border-radius: 0;
      box-shadow: none;
      pointer-events: none;
      user-select: none;
    }
    .portal-auth-card .login-card-body {
      padding: 0 2.25rem 2.5rem;
      padding-top: 0;
      background: transparent;
    }
    @media (max-width: 576px) {
      .portal-auth-card > .portal-logo-in-card {
        width: 100%;
        margin: 0px 0rem 2.5rem;
      }
    }
    .portal-auth-msg {
      text-align: center;
      font-weight: 600;
      color: var(--portal-blue);
      letter-spacing: 0.02em;
      margin-bottom: 1.1rem !important;
      font-size: 1.05rem;
    }
    .portal-auth-user {
      color: var(--portal-blue);
      font-size: 0.9rem;
    }
    .portal-auth-user span {
      color: #5a6a7a;
      font-weight: 400;
    }
    .portal-auth-card .btn-portal-blue {
      color: #fff !important;
      font-weight: 600;
      border: none;
      border-radius: 10px;
      padding: 0.65rem 1rem;
      background: linear-gradient(135deg, var(--portal-blue) 0%, var(--portal-blue-bright) 100%);
      box-shadow: 0 4px 12px rgba(13, 59, 102, 0.3);
      transition: filter 0.2s, transform 0.15s;
    }
    .portal-auth-card .btn-portal-blue:hover {
      color: #fff !important;
      filter: brightness(1.06);
      transform: translateY(-1px);
    }
    .portal-auth-card .btn-portal-red {
      color: #fff !important;
      font-weight: 600;
      border: none;
      border-radius: 10px;
      padding: 0.65rem 1rem;
      background: linear-gradient(135deg, #9c1f1f 0%, var(--portal-red) 55%, #e53935 100%);
      box-shadow: 0 4px 12px rgba(198, 40, 40, 0.35);
      transition: filter 0.2s, transform 0.15s;
    }
    .portal-auth-card .btn-portal-red:hover {
      color: #fff !important;
      filter: brightness(1.06);
      transform: translateY(-1px);
    }
    .portal-auth-card .alert-warning {
      border-radius: 10px;
      border-left: 4px solid var(--portal-red);
    }
    .portal-auth-logout {
      color: var(--portal-blue-bright) !important;
      font-weight: 500;
    }
    .portal-auth-logout:hover {
      color: var(--portal-red) !important;
      text-decoration: none;
    }
    .portal-auth-card .portal-portal-stack > a + a {
      margin-top: 0.5rem;
    }
  </style>
</head>
<body class="hold-transition login-page portal-auth-page">
<div class="login-box">
  <div class="card portal-auth-card">
    <div class="portal-logo-in-card">
      <img src="{{ asset('Logo.png') }}" alt="Optimal Solutions · Acontribut">
    </div>
    <div class="card-body login-card-body">
      <p class="login-box-msg portal-auth-msg">Seleccione el portal al que desea ingresar</p>

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

      <div class="mb-3 text-center portal-auth-user small">
        <strong>{{ $azure_name }}</strong>
        @if($azure_email)
          <br><span>{{ $azure_email }}</span>
        @endif
      </div>

      <div class="d-flex flex-column portal-portal-stack">
        @if(in_array('contabilidad', $portales_permitidos, true))
          <a href="{{ route('portal.entrar', ['portal' => 'contabilidad']) }}" class="btn btn-portal-blue btn-block btn-flat">
            <i class="fas fa-calculator mr-2"></i> Contabilidad
          </a>
        @endif
        @if(in_array('auditoria', $portales_permitidos, true))
          <a href="{{ route('portal.entrar', ['portal' => 'auditoria']) }}" class="btn btn-portal-red btn-block btn-flat">
            <i class="fas fa-clipboard-check mr-2"></i> Auditoría
          </a>
        @endif
        @if(in_array('legales', $portales_permitidos, true))
          <a href="{{ route('portal.entrar', ['portal' => 'legales']) }}" class="btn btn-portal-blue btn-block btn-flat" style="background: linear-gradient(135deg, #1b5e20 0%, #2e7d32 55%, #43a047 100%); box-shadow: 0 4px 12px rgba(27, 94, 32, 0.35);">
            <i class="fas fa-balance-scale mr-2"></i> Legales
          </a>
        @endif
      </div>

      <p class="mt-3 mb-0 text-center">
        <a href="{{ route('logout') }}" class="small portal-auth-logout">Cerrar sesión</a>
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
