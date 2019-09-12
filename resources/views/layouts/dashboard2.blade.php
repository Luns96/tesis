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
<nav class="main-header navbar  bg-light navbar-light border-bottom">
  <h2>Empresa {{ Auth::user()->company->nombre }}</h2>
    <!-- Left navbar links -->

    <!-- Right navbar links -->
    <a class="nav-link" data-widget="control-sidebar" data-slide="true"><i class="fa fa-th-large"></i></a>

    <div class="row">

        <ul class="navbar-nav ml-auto">
            <button class="btn btn-secondary" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <i class="fas fa-door-open"></i>
            Salir      
            </button>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          
        </ul>
    </div>
</nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
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
            <h3 class=" text-black">
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
  <aside class="control-sidebar control-sidebar-light" >
    <!-- Control sidebar content goes here -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('img/user/user.png') }}" class="img-circle elevation-2" alt="imagen del usuario">
        </div>
        <h3 class=" text-black">
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
<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
