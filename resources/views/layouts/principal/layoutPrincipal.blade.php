<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="description" content="" />
    <meta name="author" content="" />
    @yield("titulo")
    <link href="/css/bootstrap.css" rel="stylesheet" />
    <link href="/css/principalLayout.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    @yield('css')
</head>
<body class="sb-nav-fixed" id="bod">
<nav class="sb-topnav navbar navbar-expand navbar-dark d-flex justify-content-between" id="navSuperior">

    <div class="d-flex align-items-center">
        <a class="navbar-brand js-scroll-trigger" href="/principal" id="logo"><img src="/img/logo_blanco.PNG" width="180px"></a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
    </div>
    <!-- Navbar-->
    <div>
        <ul class="navbar-nav ml-auto ml-md-0">
            <button class="switch" id="switch">
                <span><i class="fas fa-sun"></i></span>
                <span><i class="fas fa-moon"></i></span>
            </button>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle h-100"></i></a>
                <div class="dropdown-menu dropdown-menu-right text-center pt-0 pb-0" aria-labelledby="userDropdown" id="menuUsuario">
                    <a href="{{route("perfil")}}" class="dropdown-item pb-2 pt-3">
                        <div id="imgPerfil"><img src="/img/perfil/{{ \Illuminate\Support\Facades\Session::get('usuario')->imagen }}"></div>
                        <span><b>{{\Illuminate\Support\Facades\Session::get("usuario")->nombre}}</b></span>
                    </a>
                    <div class="dropdown-divider mt-0 mb-0"></div>
                    <a class="dropdown-item pb-2 pt-2" href="{{route("perfil")}}">Perfil</a>
                    <div class="dropdown-divider mt-0 mb-0"></div>
                    <a class="dropdown-item pb-2 pt-2" href="{{ route('login.home') }}">Cerrar Sesión</a>
                </div>
            </li>
        </ul>
    </div>

</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">

                    @switch($pagina)
                        @case('principal')
                            @include('layouts.principal.menus.principal')
                           @break
                        @case('perfil')
                            @include('layouts.principal.menus.perfil')
                           @break
                        @default
                            @include('layouts.principal.menus.proyecto')
                    @endswitch
                </div>
            </div>
            <div class="bg-light sb-sidenav-footer py-3 text-center">
                <div class="small text-muted">Iniciado sesión como: <b>{{\Illuminate\Support\Facades\Session::get("usuario")->nombre}}</b></div>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            @yield("contenido")
        </main>
        <footer class="bg-light p-2">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; PlanTool 2021</div>
                    <div>
                        <img src="/img/logo_blanco.PNG" class="logo" width="130px">
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="/js/scripts.js"></script>
<script src="/js/principal.js"></script>
<script src="/js/perfil.js"></script>
@yield('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
</body>
</html>
