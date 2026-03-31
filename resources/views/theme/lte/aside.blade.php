<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{asset("Assets/$theme/index3.html")}}" class="brand-link">
      <img src="{{asset("Assets/$theme/dist/img/AdminLTELogo.png")}}"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Sistema de Gestión</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset("Assets/$theme/dist/img/user2-160x160.png")}}" 
          class="brand-image img-circle elevation-3" alt="User Image">
          </div>
          <div class="info">
          <a href="#" class="d-block">Usuario: {{session()->get('usuario')?? 'Invitado'}}</a>
          </div>
        </div>
        <div>
          <ul>
          <a href="{{route('login')}}" class="nav-link">
                  <i class="nav-icon far fa-circle text-info"></i> INICIO               
                </a>
          </ul>
        </div>
      <!-- Sidebar Menu -->
      <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset("assets/$theme/dist/img/user2-160x160.jpg")}}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Bienvenido: {{session()->get('nombre_usuario', 'Invitado')}}</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @foreach ($menusComposer as $key => $item)
                @if ($item["menu_id"] != 0)
                    @break
                @endif
                @include("theme.$theme.menu-item", ["item" => $item])
            @endforeach
        </ul>
    </div>
    <!-- /.sidebar -->
  </aside>