
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SISTEMA DE GESTION | Log in</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="{{asset("Assets/$theme/plugins/fontawesome-free/css/all.min.css")}}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{asset("Assets/$theme/plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}">
  <link rel="stylesheet" href="{{asset("Assets/$theme/dist/css/adminlte.min.css")}}">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
    :root {
      --portal-red: #c62828;
      --portal-red-soft: #e8a0a0;
      --portal-blue: #0d3b66;
      --portal-blue-bright: #1565c0;
      --portal-blue-soft: #90caf9;
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
    /* Mismo criterio que hub: margen superior suave para no recortar el banner con overflow:hidden de la card */
    .portal-auth-card > .portal-logo-in-card {
      width: 109%;
      text-align: left;
      margin: -8px -7rem 2.5rem;
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
      vertical-align: top;
    }
    .portal-auth-card .login-card-body {
      padding: 0 2.25rem 2.5rem;
      padding-top: 0;
      background: transparent;
    }
    @media (max-width: 576px) {
      .portal-auth-card > .portal-logo-in-card {
        width: 100%;
        margin: -1rem -1.25rem 1.75rem;
      }
    }
    .portal-auth-msg {
      text-align: center;
      font-weight: 600;
      color: var(--portal-blue);
      letter-spacing: 0.02em;
      margin-bottom: 1.35rem !important;
      font-size: 1.05rem;
    }
    .portal-auth-card .btn-portal-microsoft {
      position: relative;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      width: 100%;
      padding: 0.75rem 1rem;
      font-weight: 600;
      border: none;
      border-radius: 10px;
      color: #fff !important;
      background: linear-gradient(135deg, var(--portal-blue) 0%, var(--portal-blue-bright) 45%, #0a4a8c 100%);
      box-shadow: 0 4px 14px rgba(13, 59, 102, 0.35);
      transition: filter 0.2s ease, transform 0.15s ease, box-shadow 0.2s ease;
    }
    .portal-auth-card .btn-portal-microsoft::after {
      content: '';
      position: absolute;
      left: 0;
      right: 0;
      top: 0;
      height: 3px;
      border-radius: 10px 10px 0 0;
      background: linear-gradient(90deg, var(--portal-red), transparent 40%);
      opacity: 0.85;
      pointer-events: none;
    }
    .portal-auth-card .btn-portal-microsoft:hover {
      color: #fff !important;
      filter: brightness(1.06);
      transform: translateY(-1px);
      box-shadow: 0 6px 18px rgba(13, 59, 102, 0.4);
    }
    .portal-auth-card .alert-warning {
      border-radius: 10px;
      border-left: 4px solid var(--portal-red);
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
      <p class="login-box-msg portal-auth-msg">Inicie sesión para continuar</p>
      @if ($errors->any())
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
        @endif

      <div class="mb-0">
        <a href="{{ route('auth.azure.redirect') }}" class="btn btn-portal-microsoft btn-block btn-flat">
          <i class="fab fa-microsoft"></i> Iniciar sesión con Microsoft
        </a>
      </div>
    </div>
  </div>
</div>

<script src="{{asset("Assets/lte/plugins/jquery/jquery.min.js")}}"></script>
<script src="{{asset("Assets/lte/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<script src="{{asset("Assets/$theme/dist/js/adminlte.min.js")}}"></script>
    <script src="{{asset("Assets/lte/plugins/jquery/jquery.min.js")}}"></script>
    <script src="{{asset("Assets/$theme/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
    <script src="{{asset("Assets/$theme/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")}}"></script>
    <script src="{{asset("Assets/$theme/dist/js/adminlte.min.js")}}"></script>
    @yield('scriptPlugins')
    <script src="{{asset("Assets/js/jquery-validation/jquery.validate.min.js")}}"></script>
    <script src="{{asset("Assets/pages/script/admin/menu-rol/index.js")}}"></script>
    <script src="{{asset("Assets/lte/pages/scripts/admin/menu/index.js")}}"></script>
    <script src="{{asset("Assets/js/jquery-validation/localization/messages_es.min.js")}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{asset("Assets/js/script.js")}}"></script>
    <script src="{{asset("Assets/js/funciones.js")}}"></script>
   @yield('script')

</body>
</html>
