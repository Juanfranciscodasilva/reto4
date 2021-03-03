@extends("layouts.principal.layoutPrincipal")

@section("titulo")
    <title>PlanTool - Proyecto</title>
@endsection

@section("css")
    <link href="/css/crearTarea.css" rel="stylesheet" />
@endsection

@section("contenido")
    <div class="container-fluid mt-3" id="contenedorPadre">
        <div class="col-10 col-xl-7 mx-auto" id="contenedorFormulario">
            <form action="{{route("crearTarea")}}" method="post" onsubmit="return validarDatosCrearProyecto()" class="col-12 col-lg-9 p-0 mx-auto mb-0" autocomplete="off">
                @csrf
                <h1 class="m-0 pt-2 pb-2">Crear tarea</h1>
                <div class="mt-4 text-md-center col-11 col-md-9 mx-auto">
                    <label for="titulo">Título: </label>
                    <input type="text" id="titulo" name="titulo" class="text-md-center" maxlength="255" required>
                </div>
                <div class="text-md-center col-11 col-md-9 mx-auto">
                    <label for="desc">Descripción: </label>
                    <textarea id="desc" name="descripcion" maxlength="255" class="text-md-center" required></textarea>
                </div>
                <div class="text-md-center col-11 col-md-9 mx-auto">
                    <label for="fecha">Fecha de vencimiento: </label>
                    <input type="date" name="fecha" id="fecha" class="text-md-center" required>
                    <span id="errorFecha" class="mensajeError">Fecha seleccionada pasada</span>
                </div>
                <div class="text-md-center col-11 col-md-9 mx-auto">
                    <label for="asignado">Asignar a: </label>
                    <select id="asignar" name="asignado" required class="selector">
                        <option value="null">--- Selecciona un integrante ---</option>
                        @foreach($integrantes as $integrante)
                            <option value="{{$integrante->id}}">{{$integrante->usuario}}</option>
                        @endforeach
                    </select>
                    <span id="errorIntegrante" class="mensajeError">Selecciona un integrante a quien asignar</span>
                </div>

                <input type="number" name="time" id="time" hidden>
                <div class="col-11 col-md-9 mx-auto mt-3">
                    <button type="submit" class="boton">Crear</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section("script")
    <script src="js/proyecto.js"></script>
@endsection
