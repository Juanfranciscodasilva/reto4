@extends("layouts.principal.layoutPrincipal")

@section("titulo")
    <title>PlanTool - Principal</title>
@endsection
@section('css')
    <link href="/css/principal.css" rel="stylesheet" />
    <link href="/css/paginacion.css" rel="stylesheet" />
@endsection
@section("contenido")
    <div class="container" style="margin-bottom: 30px" id="contenedorPadre">
        @if(count($listaproyectos["proyectos"]) == 0)
            <div id="noProyectos">
                <h1 class="text-dark">No tienes proyectos!</h1>
                <p class="text-dark"><b>Únete mediante invitación o crea uno propio!</b></p>
            </div>
        @else
            <h1 class="mt-4 pt-0 mt-xl-5 pt-xl-4">Mis proyectos</h1>
                <div id="proyectos" class="mt-xl-5">
                    @foreach($listaproyectos["proyectos"] as $proyecto)
                        <div class="proyectodatos col-12 mx-auto mx-lg-0 col-lg-6 col-xl-4">
                            <a href="/proyecto/{{$proyecto->id}}">
                                <div class="proyecto">
                                    <h2>{{$proyecto->titulo}}</h2>
                                    <div>
                                        <span>Creado por:&nbsp;</span>
                                        <button class="botonperfil" style="text-decoration: underline" onclick="mostrarperfil(event,this)" id="{{ $proyecto->coordinador->id }}"><b>{{$proyecto->coordinador->usuario}}</b></button>
                                    </div>
                                    <div>
                                        <p>{{substr($proyecto->descripcion,0,30)}}
                                        @if(strlen($proyecto->descripcion) > 30)
                                            ...
                                        @endif
                                        </p>
                                    </div>
                                    <div>
                                        <span>Fecha: {{$proyecto->created_at->format("d/m/Y")}}</span>
                                    </div>
                                    <div class="d-flex p-0 pb-2 justify-content-around">
                                        @if($proyecto->estado)
                                            <div>
                                                <i class="fas fa-lock" style="margin-top: 6px;color: #a16aff;margin-right: 5px"></i>
                                                <span style="color: #a16aff">privado</span>
                                            </div>
                                        @else
                                            <div>
                                                <i class="fas fa-book-open" style="margin-top: 6px;color: #a16aff;margin-right: 5px"></i>
                                                <span style="color: #a16aff">público</span>
                                            </div>
                                        @endif
                                          @if($proyecto->favorito)
                                                <button class="botonperfil amarillo" id="{{ $proyecto->id }}" onclick="quitarfavorito(this,event)">
                                                    <i class="fas fa-star" style="margin-top: 3px;margin-left: 12px;color: #a16aff"></i>
                                                    <span style="color: #a16aff">añadir a favoritos</span>
                                                </button>
                                            @else
                                                <button class="botonperfil" onclick="añadirfavorito(this,event)" id="{{ $proyecto->id }}">
                                                    <i class="fas fa-star" style="margin-top: 3px;margin-left: 12px;color: #a16aff"></i>
                                                    <span style="color: #a16aff">añadir a favoritos</span>
                                                </button>
                                            @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                {{ $listaproyectos["ids"]->onEachSide(0)->links('pagination::bootstrap-4') }}
        @endif
    </div>
@endsection

