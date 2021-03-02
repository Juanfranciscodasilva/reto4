@extends("layouts.principal.layoutPrincipal")

@section("titulo")
    <title>PlanTool - Proyecto</title>
@endsection

@section("css")
    <link href="/css/proyecto.css" rel="stylesheet" />
@endsection

@section("contenido")
    <div class="container" id="contenedorPadre">
        <div class="col-11 mx-auto" id="contenedorFormulario">
            <h1 class="m-0 pt-2 pb-3">{{$proyecto->titulo}}</h1>
            <br/>
            <div class="datos row">
                <div class="col-12">
                    <div class="datos m-0 mt-2 text-center w-100">
                        <p>{{$proyecto->descripcion}}</p>
                        <hr>
                        <p><b>Fecha de entrada:</b> {{$fecha_entrada->format("d/m/Y")}}</p>
                        <p><b>Coordinador:<button class="botonperfil" style="text-decoration: underline;margin-left: 2px" onclick="mostrarperfil(event,this)" id="{{ $coordinador->id }}"><b>{{$coordinador->usuario}}</b></button></b></p>
                        <p><b>Integrantes:</b> {{$integrantes}}</p>
                        @if($coordinador)
                            <p id="botonAdd"><a href="{{route("integrantes")}}"><button id="addIntegrante">Añadir integrante</button></a></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
