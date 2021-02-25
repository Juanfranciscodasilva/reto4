<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    @yield("titulo")
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/principalLayout.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    @yield('css')
</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark d-flex justify-content-between" id="navSuperior">

    <div class="d-flex align-items-center">
        <a class="navbar-brand js-scroll-trigger" href="/principal" id="logo"><img src="img/logo_blanco.png" width="180px"></a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
    </div>
    <!-- Navbar-->
    <div>
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right text-center" aria-labelledby="userDropdown" id="menuUsuario">
                    <a href="{{route("perfil")}}" class="dropdown-item">
                        <div id="imgPerfil"><img src="img/logo.png"></div>
                        <span>{{\Illuminate\Support\Facades\Session::get("usuario")->nombre}}</span>
                    </a>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route("perfil")}}">Perfil</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/">Cerrar Sesión</a>
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
                    <a class="nav-link" href="/principal">
                        <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                        Inicio
                    </a>
                    @if($pagina == "principal")
                        <div class="sb-sidenav-menu-heading">General</div>
                        <a class="nav-link" href="{{route("proyectos")}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                            Proyectos
                        </a>
                        <a class="nav-link" href="{{route("crear")}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-folder-plus"></i></div>
                            Crear proyecto
                        </a>
                        <div class="sb-sidenav-menu-heading">Perfil</div>
                        <a class="nav-link" href="{{route("perfil")}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                            Perfil
                        </a>
                        <a class="nav-link" href="/">
                            <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                            Cerrar sesión
                        </a>
                    @else
                        @if($pagina == "perfil")
                            <div class="sb-sidenav-menu-heading">Perfil</div>
                            <a class="nav-link" href="{{route("perfil")}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Mi perfil
                            </a>
                            <a class="nav-link" href="{{route("proyectos")}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-key"></i></div>
                                Cambiar contraseña
                            </a>
                            <a class="nav-link" href="{{route("proyectos")}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-images"></i></div>
                                Cambiar imágen
                            </a>
                            <a class="nav-link" href="{{route("proyectos")}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-id-card"></i></div>
                                Cambiar datos
                            </a>
                            <a class="nav-link" href="{{route("proyectos")}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-trash"></i></div>
                                Eliminar usuario
                            </a>
                            <a class="nav-link" href="/">
                                <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                                Cerrar sesión
                            </a>
                        @else
                            <div class="sb-sidenav-menu-heading">Proyecto</div>

                            <a class="nav-link" href="{{route("proyecto")}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-comment-dots"></i></div>
                                Chat
                            </a>
                            <a class="nav-link" href="{{route("proyecto")}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list"></i></div>
                                Mis tareas
                            </a>
                            <a class="nav-link" href="{{route("proyecto")}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-friends"></i></div>
                                Integrantes
                            </a>

                            <div class="sb-sidenav-menu-heading">Perfil</div>

                            <a class="nav-link" href="{{route("perfil")}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Perfil
                            </a>
                            <a class="nav-link" href="/">
                                <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                                Cerrar sesión
                            </a>
                        @endif
                    @endif

                </div>
            </div>
            <div class="sb-sidenav-footer py-3">
                <div class="small">Iniciado sesión como: {{\Illuminate\Support\Facades\Session::get("usuario")->nombre}}</div>

            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            @yield("contenido")
        </main>
        <footer class=" bg-light mt-auto p-2">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; PlanTool 2021</div>
                    <div>
                        <img src="img/logo.png" width="130px">
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
</body>
</html>
