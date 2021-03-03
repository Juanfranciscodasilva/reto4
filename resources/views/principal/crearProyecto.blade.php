@extends("layouts.principal.layoutPrincipal")

@section("titulo")
    <title>PlanTool - Principal</title>
@endsection
@section("css")
    <link href="css/crearProyecto.css" rel="stylesheet" />
@endsection
@section("contenido")
    <div class="container-fluid" id="contenedorPadre">
        <div class="col-12 col-xl-7 mx-auto" id="contenedorFormulario">
            <form action="{{route("crearProyecto")}}" method="post" class="col-11 col-lg-9 col-xl-10 mx-auto">
            @csrf
            <h1 class="m-0 pt-2 pb-2">Crear proyecto</h1>
            <div class="mt-4 text-md-center col-12 col-md-9 mx-auto">
                <label for="titulo">Título: </label>
                <input type="text" id="titulo" name="titulo" class="text-md-center" value="{{old("titulo")}}" required autocomplete="off">
                {!! $errors->first('titulo','<span style="color: red; margin-top: 10px;">:message</span>') !!}
            </div>
            <div class="text-md-center col-12 col-md-9 mx-auto">
                <label for="desc">Descripción: </label>
                <textarea id="desc" name="descripcion" class="text-md-center" required>{{old("descripcion")}}</textarea>
            </div>
            <div class="col-12 col-md-9 mx-auto">
                <div class="d-flex flex-row mt-2">
                    <input type="radio" name="estado" checked="checked" value="publico" style="margin-top: 3px;margin-right: 3px"><i class="fas fa-book-open" style="width: 30px;padding-bottom: 2px;margin-top: 3px;margin-right: 3px"></i><span class="small"><b>Público</b><br />Cualquiera en internet puede ver la información privada de tu proyecto</span>
                </div>
                <div class="d-flex flex-row mb-0">
                    <input type="radio" name="estado" value="privado" style="margin-top: 3px;margin-right: 3px"><i class="fas fa-lock" style="width: 30px;padding-bottom: 2px;margin-top: 3px;margin-right: 3px"></i><span class="small"><b>Privado</b><br />Tu eliges quien puede ver la información privada de tu proyecto</span>
                </div>
            </div>
            <div class="col-12 col-md-9 mt-3 mt-xl-1 mx-auto">
                <button type="submit" class="boton">Crear</button>
            </div>

            </form>
        </div>
    </div>
@endsection
