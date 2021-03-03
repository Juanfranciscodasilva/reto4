@extends("layouts.principal.layoutPrincipal",["usuarioreal",$usuarioreal])

@section("titulo")
    <title>PlanTool - Perfil</title>
@endsection
@section("css")
    <link href="css/perfil.css" rel="stylesheet" />
@endsection
@section("contenido")
    <div class="container" id="contenedorPadre">
        <div class="col-12 mx-auto" id="contenedorFormulario">
            <h1 class="m-0 pt-2 pb-2">Modificar Perfil</h1>
            <div class="col-12 col-md-8 mx-auto">
                <form class="mt-3" action="{{ route('modificarperfil') }}" method="post">
                    @csrf @method('PATCH')
                    <div class="row">
                        <div class="col-lg-6 text-md-center">
                            <label>Nombre:</label>
                            <input type="text" name="nombre" class="col-12 text-md-center" value="{{\Illuminate\Support\Facades\Session::get('usuario')->nombre}}" required>
                        </div>
                        <div class="col-lg-6 mt-3 mt-lg-0 text-md-center">
                            <label>Apellidos:</label>
                            <input type="text" name="apellidos" class="col-12 text-md-center" value="{{\Illuminate\Support\Facades\Session::get('usuario')->apellidos}}" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-6 text-md-center">
                            <label>Usuario:</label>
                            <input type="text" name="usuario" class="col-12 text-md-center" value="{{\Illuminate\Support\Facades\Session::get('usuario')->usuario}}" required>
                        </div>
                        <div class="col-lg-6 mt-3 mt-lg-0 text-md-center">
                            <label>Email:</label>
                            <input type="email" name="email" class="col-12 text-md-center" value="{{\Illuminate\Support\Facades\Session::get('usuario')->email}}" required>
                        </div>
                    </div>
                    @include('layouts.error.errores')
                    <button type="submit" class="boton w-100 mt-2 pt-1 pb-1">Modificar Perfil</button>
                  </div>
                </form>
        </div>
    </div>
@endsection
