@extends("layouts.principal.layoutPrincipal")

@section("titulo")
    <title>PlanTool - Principal</title>
@endsection
@section("css")
    <link href="/css/crearProyecto.css" rel="stylesheet" />
@endsection
@section("contenido")
    <div class="container-fluid" id="contenedorPadre">
        <div class="col-10 col-xl-7 mx-auto" id="contenedorFormulario">
            <form action="{{ route('contactar') }}" method="post" class="col-11 col-lg-9 col-xl-11 mx-auto">
                @csrf
                <h1 class="m-0 pt-2 pb-2">Contacto</h1>
                <div class="mt-4 text-md-center col-11 col-md-9 mx-auto">
                    <label for="email">Email: </label>
                    <input type="text" id="email" name="email" class="text-md-center" value="{{ \Illuminate\Support\Facades\Session::get('usuario')->email }}" readonly>
                </div>
                <div class="text-md-center col-11 col-md-9 mx-auto">
                    <label for="men">Mensaje: </label>
                    <textarea id="men" name="mensaje" class="text-md-center" required></textarea>
                </div>
                <div class="col-11 col-md-9 mt-3 mx-auto">
                    <button type="submit" class="boton">Contactar</button>
                </div>
            </form>
        </div>
    </div>
@endsection

