<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Panel administrativo</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/app2.css') }}" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
<nav class="main-header navbar  bg-dark navbar-dark border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
            

        <li class="nav-item row">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
            &nbsp;&nbsp;&nbsp;
            <h2>Empresa {{ Auth::user()->company->nombre }}</h2>
        </li>
    </ul>

    <!-- SEARCH FORM -->
    {{-- <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </form> --}}

    <!-- Right navbar links -->
    

    <div class="row">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true"><i class="fa fa-th-large"></i></a>
        <ul class="navbar-nav ml-auto">
            <button class="btn btn-dark" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <i class="fas fa-door-open"></i>
            Salir      
            </button>
            {{-- <a class="button" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a> --}}

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          
        </ul>
    </div>
</nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <span class="brand-text font-weight-light">Aplicacion</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('img/user/user.png') }}" class="img-circle elevation-2" alt="imagen del usuario">
            </div>
            <h3 class=" text-white">
                {{ Auth::user()->roles[0]->name }}
            </h3>
        </div>

      <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header"> 
                    <h3><i class="nav-icon fa fa-th"></i> 
                        PANEL 
                    </h3>
                    <h3>ADMINISTRATIVO</h3>
                    
                </li>
                @hasrole('Administrador')
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link">
                        <h4>
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Usuario
                            </p>
                        </h4>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('company.index') }}" class="nav-link">
                        <h4>
                            <i class="nav-icon far fa-building"></i>
                            <p>
                                Empresas
                            </p>
                        </h4>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('type.index') }}" class="nav-link">
                        <h4>
                            <i class="nav-icon fas fa-industry"></i>
                            <p>
                                Tipos de empresas
                            </p>
                        </h4>
                    </a>
                </li>
                @endhasrole
                @hasrole('SuperGerente')
                <li class="nav-item">
                    <a href="{{ route('user.indexGerente') }}" class="nav-link">
                        <h4>
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Usuario
                            </p>
                        </h4>
                    </a>
                </li>
                @endhasrole
                @hasrole('SuperGerente|Gerente')
                <li class="nav-item">
                    <a href="{{ route('project.index') }}" class="nav-link">
                        <h4>
                            <i class="nav-icon fas fa-network-wired"></i>
                            <p>
                                Proyectos
                            </p>
                        </h4>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <h4>
                            <i class="nav-icon fas fa-chart-bar"></i>
                            <p>
                                Estadistica
                            </p>
                        </h4>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <h4>
                            <i class="nav-icon fas fa-tools"></i>
                            <p>
                                Configuracion
                            </p>
                        </h4>
                    </a>
                </li>
                @endhasrole
            {{-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/examples/404.html" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Error 404</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/500.html" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Error 500</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/blank.html" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Blank Page</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="starter.html" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Starter Page</p>
                </a>
              </li>
            </ul> --}}
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  {{-- Contenido --}}
  @yield('content')
  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark" >
    <!-- Control sidebar content goes here -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('img/user/user.png') }}" class="img-circle elevation-2" alt="imagen del usuario">
        </div>
        <h3 class=" text-white">
            {{ Auth::user()->nombre }}
        </h3>
    </div>
    
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <a href="{{ route('home') }}" class="nav-link">
            <h3 class="text-center"><i class="nav-icon fas fa-user"></i>&nbsp;Cuenta personal</h3>
            </a>
            <a href="{{ route('auth.reset') }}" class="nav-link">
                <h3 class="text-center"><i class="nav-icon fas fa-key"></i>&nbsp;Cambio de clave</h3>
            </a>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item has-treeview">
                <a href="" class="nav-link">
                <p>
                   <h3 class="text-center">
                        <i class="nav-icon fas fa-mail-bulk"></i>
                        Buzon mensaje
                        <i class="right fas fa-angle-left"></i>
                    </h3> 
                    
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/" class="nav-link">
                        <h5 class="">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Recibido</p>
                        </h5>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/" class="nav-link">
                        <h5 class="">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Enviado</p>
                        </h5>
                    </a>
                </li>
                </ul>
            </li>
        </ul>
    </ul>
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
