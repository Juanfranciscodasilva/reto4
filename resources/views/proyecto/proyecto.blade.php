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
            <div class="datos row">
                <div class="col-12">
                    <div class="datos mt-3 text-center w-100">
                        <p>{{$proyecto->descripcion}}</p>
                        <hr>
                        <p><b>Fecha de entrada:</b> {{$fecha_entrada->format("d/m/Y")}}</p>
                        <p><b>Coordinador:<button class="botonperfil" style="text-decoration: underline;margin-left: 2px" onclick="mostrarperfil(event,this)" id="{{ $coordinador->id }}"><b>{{$coordinador->usuario}}</b></button></b></p>
                        <p><b>Integrantes:</b> {{$integrantes}}</p>
                        @if($permiso == 2)
                            @if(!$estado)
                                <a href="{{route("integrantes")}}" class="enlace"><i class="fas fa-user-friends"></i> Integrantes</a>
                                <a href="{{route("archivos")}}" class="enlace"><i class="fas fa-file-alt"></i> Archivos</a>
                            @endif
                        @else
                            @if(!$estado)
                                <p><b>Estado: </b>público</p>
                            @else
                                <p><b>Estado: </b>privado</p>
                            @endif
                            <a href="{{route("integrantes")}}" class="enlace" style="margin-right: 25px"><i class="fas fa-user-friends"></i> Integrantes</a>
                            <a href="{{route("archivos")}}" class="enlace"><i class="fas fa-file-alt"></i> Archivos</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
