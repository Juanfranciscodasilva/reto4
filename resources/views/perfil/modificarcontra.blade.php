@extends("layouts.principal.layoutPrincipal",["usuarioreal",$usuarioreal])

@section("titulo")
    <title>PlanTool - Perfil</title>
@endsection
@section("css")
    <link href="css/perfil.css" rel="stylesheet" />
@endsection
@section("contenido")
    <div class="container mt-5 mb-5" id="contenedorPadre">
        <div class="col-12 mx-auto" id="contenedorFormulario">
            <h1 class="m-0 pt-2 pb-2">Modificar Contraseña</h1>
            <form id="formregist" action="{{ route('modificarcontra') }}" method="post" class="col-12 col-md-7 mx-auto mt-4 text-center">
                @csrf @method('PATCH')
                <label>Contraseña actual</label>
                <input type="password" name="contract" style="text-align: center" required>
                <label class="mt-3">Nueva contraseña</label>
                <input type="password" id="pass" name="pass" style="text-align: center" required pattern="^[A-z0-9]+$" minlength="8">
                <label class="mt-3">Confirmar contraseña</label>
                <input type="password" id="repass" name="repass" class="mb-2" style="text-align: center" required pattern="^[A-z0-9]+$" minlength="8">
                @if(isset($error))
                    <div class="mt-2 error2 text-center" role="alert">
                        <div class="alert alert-danger">
                            <span>{{ $error }}</span>
                        </div>
                    </div>
                    <div class="error mt-0 mb-2">
                    </div>
                    <button type="submit" class="boton w-100 pt-1 pb-1">Modificar Contraseña</button>
                @else
                   <div class="error mt-3">
                   </div>
                   <button type="submit" class="boton w-100 pt-1 pb-1 mt-2">Modificar Contraseña</button>
                @endif

            </form>
        </div>
    </div>
@endsection
@section('script')
    <script src="/js/login/registro.js"></script>
@endsection
