@extends("layouts.principal.layoutPrincipal")

@section("titulo")
    <title>PlanTool - Proyecto</title>
@endsection

@section("css")
    <link href="/css/tareas.css" rel="stylesheet" />
    <link href="/css/paginacion.css" rel="stylesheet" />
@endsection

@section("contenido")
    <div class="container">
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
            <h1>Tareas {{$estado}}</h1>
            <div id="tareas">
                @foreach($tareas as $tarea)
                    <div class="tarea">
                        <h2>{{$tarea->titulo}}</h2>
                        <p>{{$tarea->descripcion}}</p>
                        <div>
                            <span>Fecha límite: {{$tarea->vencimiento}}</span>
                            @if($estado == "activas")
                                <span>Estado: asginada</span>
                            @else
                                <span>Estado: finalizada</span>
                            @endif
                        </div>
                        @if($estado == "activas")
                            <form action="{{route("finalizarTarea")}}" method="post">
                                @csrf
                                <input type="hidden" value="{{$tarea->id}}" name="tarea">
                                <button type="submit">Finalizar</button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
            {{ $paginacion->links('pagination::bootstrap-4') }}
        @endif
    </div>
@endsection
