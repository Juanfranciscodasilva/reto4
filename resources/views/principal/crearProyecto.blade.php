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
            <form action="{{route("crearProyecto")}}" method="post" class="col-11 col-lg-9 col-xl-7 mx-auto">
            @csrf
            <h1>Crear proyecto</h1>
            <div>
                <label for="titulo">Título: </label>
                <input type="text" id="titulo" name="titulo" value="{{old("titulo")}}" required>
                {!! $errors->first('titulo','<span style="color: red; margin-top: 10px;">:message</span>') !!}
            </div>
            <div>
                <label for="desc">Descripción: </label>
                <textarea id="desc" name="descripcion" required>{{old("descripcion")}}</textarea>
            </div>
            <button type="submit">Crear</button>

            </form>
        </div>
    </div>
@endsection
