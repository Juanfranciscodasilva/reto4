<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>PlanTool- Login</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="/"><img src="img/logo.png" width="180px"></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    @if($seleccionado == 0)
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="/" style="text-decoration: underline">Iniciar sesión</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="/">Iniciar sesión</a></li>
                    @endif

                    @if($seleccionado == 1)
                            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#projects" style="text-decoration: underline">Registrarse</a></li>
                    @else
                            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#projects">Registrarse</a></li>
                    @endif

                    @if($seleccionado == 2)
                            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#signup" style="text-decoration: underline">Restablecer contraseña</a></li>
                    @else
                            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#signup">Restablecer contraseña</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @yield("cuerpo")
    <!-- Bootstrap core JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
</body>
</html>
