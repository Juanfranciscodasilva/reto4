<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>PlanTool</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/login.css" rel="stylesheet" />
</head>
<body id="page-top">
<!-- Navigation-->
<nav class="navbar navbar-expand-md navbar-light" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="{{ route('login.home') }}"><img src="img/logo.png" width="180px"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars ms-2"></i>
        </button>

        <div class="collapse navbar-collapse d-md-flex flex-row-reverse pt-mb-0" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                @if($seleccionado == 0)
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="/" style="text-decoration: underline;color: #7A01C9">Iniciar sesión</a></li>
                @else
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="/">Iniciar sesión</a></li>
                @endif

                @if($seleccionado == 1)
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ route('registro.index') }}" style="text-decoration: underline;color: #7A01C9">Registrarse</a></li>
                @else
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ route('registro.index') }}">Registrarse</a></li>
                @endif

                @if($seleccionado == 2)
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#signup" style="text-decoration: underline;color: #7A01C9">Restablecer contraseña</a></li>
                @else
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#signup">Restablecer contraseña</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<header class="masthead">
    <div class="container">
        @yield('contenido')
    </div>
</header>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/login/registro.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Third party plugin JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
</body>
</html>
