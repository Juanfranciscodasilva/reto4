@extends("layouts.principal.layoutPrincipal")

@section("titulo")
    <title>PlanTool - Proyecto</title>
@endsection

@section("css")
    <link href="/css/principal.css" rel="stylesheet" />
    <link href="/css/tareas.css" rel="stylesheet" />
    <link href="/css/paginacion.css" rel="stylesheet" />
@endsection

@section("contenido")
    <div class="container" id="contenedorPadre">
        @if(count($tareas)==0)
            <div id="noTareas">
                <h1>No tienes tareas {{$estado}}</h1>
                @if($estado == "activas")
                 <p>Espera a que te asignen una tarea</p>
                @else
                    <p>Finaliza alguna de tus tareas</p>
                @endif
            </div>
        @else
            <h1 class="mt-4 pt-0 mt-xl-5 pt-xl-4">Tareas {{$estado}}</h1>
            <div id="proyectos" class="mt-xl-5">
                @foreach($tareas as $tarea)
                    <div class="proyectodatos col-12 mx-auto mx-lg-0 col-lg-6 col-xl-4">
                        <div class="proyecto">
                            <h2>{{$tarea->titulo}}</h2>
                            <p class="col-11 mx-auto mt-3 mb-2">{{$tarea->descripcion}}</p>
                            @if($estado == "activas")
                                <div class="d-flex justify-content-around flex-wrap">
                            @else
                               <div class="d-flex justify-content-around flex-wrap mb-2">
                             @endif
                                <span>Fecha límite: {{$tarea->vencimiento}}</span>
                                @if($estado == "activas")
                                    <span>Estado: asginada</span>
                                @else
                                    <span>Estado: finalizada</span>
                                @endif
                            </div>
                            @if($estado == "activas")
                                <div>
                                    <form action="{{route("finalizarTarea")}}" method="post" class="w-100 d-flex justify-content-center">
                                        @csrf
                                        <input type="hidden" value="{{$tarea->id}}" name="tarea">
                                        <button type="submit" class="finalizar w-50">Finalizar</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $paginacion->links('pagination::bootstrap-4') }}
        @endif
    </div>
@endsection
