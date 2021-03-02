@extends("layouts.principal.layoutPrincipal")

@section("titulo")
    <title>PlanTool - Principal</title>
@endsection
@section("css")
    <link href="css/crearProyecto.css" rel="stylesheet" />
@endsection
@section("contenido")
    <div class="container-fluid" id="contenedorPadre">
        <div class="col-10 col-xl-7 mx-auto" id="contenedorFormulario">
            <form action="{{route("crearProyecto")}}" method="post" class="col-11 col-lg-9 col-xl-10 mx-auto">
            @csrf
            <h1 class="m-0 pt-2 pb-2">Crear proyecto</h1>
            <div class="mt-4 text-md-center col-11 col-md-9 mx-auto">
                <label for="titulo">Título: </label>
                <input type="text" id="titulo" name="titulo" class="text-md-center" value="{{old("titulo")}}" required autocomplete="off">
                {!! $errors->first('titulo','<span style="color: red; margin-top: 10px;">:message</span>') !!}
            </div>
            <div class="text-md-center col-11 col-md-9 mx-auto">
                <label for="desc">Descripción: </label>
                <textarea id="desc" name="descripcion" class="text-md-center" required>{{old("descripcion")}}</textarea>
            </div>
            <div class="col-11 col-md-9 mx-auto">
                <button type="submit" class="boton">Crear</button>
            </div>

            </form>
        </div>
    </div>
@endsection
