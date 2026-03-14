<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('titulo','Sistema de Gestión')|Contable</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset("Assets/$theme/plugins/fontawesome-free/css/all.min.css")}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <!--<link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">-->
  <link rel="stylesheet" href="{{asset("Assets/$theme/plugins/overlayScrollbars/css/OverlayScrollbars.min.css")}}">
  <!-- Theme style -->
  <!-- <link rel="stylesheet" href="../../dist/css/adminlte.min.css">-->
  <link rel="stylesheet" href="{{asset("Assets/$theme/dist/css/adminlte.min.css")}}">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
   <!-- <link rel="stylesheet" href="../../dist/css/custom.css">-->
   @yield('styles')
   <link rel="stylesheet" href="{{asset("Assets/css/custom.css")}}">
   <link rel="stylesheet" href="{{asset("Assets/lte/dist/css/custom.css")}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
</head><body class="hold-transition sidebar-mini layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">

<!-- Site header -->
@include("theme/$theme/header")
<!-- fin header -->
<!-- Site asaid -->
@include("theme/$theme/aside")
<!-- fin asaid -->


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content">
          <div class="container-fluid">
                <h3 class="card-title">@yield('titulopag','Contenido Para Gestionar')</h3>

                <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        
                </div>
                            
                <div class="card-body">
                    @yield('contenido', 'Contenido no cargado')
                </div>
             
            
            </div><!-- /.container-fluid -->
        </section>
    </div>
    <!-- content inicio footer -->
    @include("theme/$theme/footer")
    <!-- fin footer -->
    
       
</div>

    <!-- jQuery -->
    <script src="{{asset("Assets/lte/plugins/jquery/jquery.min.js")}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset("Assets/$theme/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset("Assets/$theme/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset("Assets/$theme/dist/js/adminlte.min.js")}}"></script>
    <!-- AdminLTE for demo purposes  http://127.0.0.1/index.js -->
    @yield('scriptPlugins')
    <script src="{{asset("Assets/js/jquery-validation/jquery.validate.min.js")}}"></script>
    <script src="{{asset("Assets/pages/script/admin/menu-rol/index.js")}}"></script>
    <script src="{{asset("Assets/pages/script/admin/permiso-rol/index.js")}}"></script>
    <script src="{{asset("Assets/lte/pages/scripts/admin/menu/index.js")}}"></script>
    <script src="{{asset("Assets/js/jquery-validation/localization/messages_es.min.js")}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{asset("Assets/js/script.js")}}"></script>
    <script src="{{asset("Assets/js/funciones.js")}}"></script>
   @yield('script')
   <script>
   (function () {
     var debug = @json(session('debug_entrar_portal'));
     if (debug) {
       console.log('%c========== DEBUG Entrada a portal (BD) ==========', 'font-size:14px; font-weight:bold');
       console.log('%cPortal, usuario y roles cargados de la base de datos:', 'font-weight:bold; color:#880088');
       console.log(debug);
       console.log('%c==================================================', 'font-size:14px; font-weight:bold');
     }
   })();
   </script>
</body>
</html>