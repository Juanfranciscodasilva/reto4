@extends("layouts.principal.layoutPrincipal")

@section("titulo")
    <title>PlanTool - Proyecto</title>
@endsection

@section("css")
    <link href="css/crearTarea.css" rel="stylesheet" />
@endsection

@section("contenido")
    <div class="container">
        <div class="col-10 col-xl-7 mx-auto" id="contenedorFormulario">
            <form action="{{route("crearTarea")}}" method="post" onsubmit="return validarDatosCrearProyecto()" class="col-11 col-lg-9 col-xl-7 mx-auto">
                @csrf
                <h1>Crear tarea</h1>
                <div>
                    <label for="titulo">Título: </label>
                    <input type="text" id="titulo" name="titulo" maxlength="255" required>
                </div>
                <div>
                    <label for="desc">Descripción: </label>
                    <textarea id="desc" name="descripcion" maxlength="255" required></textarea>
                </div>
                <div>
                    <label for="fecha">Fecha de vencimiento: </label>
                    <input type="date" name="fecha" id="fecha" required>
                    <span id="errorFecha" class="mensajeError">Fecha seleccionada pasada</span>
                </div>
                <div>
                    <label for="fecha">Asignar a: </label>
                    <select id="asignar" name="asignado" required>
                        <option value="null">--- Selecciona un integrante ---</option>
                        @foreach($integrantes as $integrante)
                            <option value="{{$integrante->id}}">{{$integrante->usuario}}</option>
                        @endforeach
                    </select>
                    <span id="errorIntegrante" class="mensajeError">Selecciona un integrante a quien asignar</span>
                </div>

                <input type="number" name="time" id="time" hidden>
                <button type="submit">Crear</button>

            </form>
        </div>
    </div>
@endsection

@section("script")
    <script src="js/proyecto.js"></script>
@endsection
