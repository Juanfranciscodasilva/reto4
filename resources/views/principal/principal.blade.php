@extends("layouts.principal.layoutPrincipal")

@section("titulo")
    <title>PlanTool - Principal</title>
@endsection
@section('css')
    <link href="css/principal.css" rel="stylesheet" />
    <link href="css/paginacion.css" rel="stylesheet" />
@endsection
@section("contenido")
    <div class="container">
        @if(count($proyectos["proyectos"]) == 0)
            <div id="noProyectos">
                <h1>No tienes proyectos!</h1>
                <p>Únete mediante invitación o crea uno propio!</p>
            </div>
        @else
            <div id="proyectos">
            @foreach($proyectos["proyectos"] as $proyecto)
                    <div>
                        <a href="/proyecto/{{$proyecto->id}}">
                            <div class="proyecto">
                                <h2>{{$proyecto->titulo}}</h2>
                                <div>
                                    <span>Creado por: {{$proyecto->coordinador->usuario}}</span>
                                </div>
                                <div>
                                    <p>{{$proyecto->descripcion}}</p>
                                </div>
                                <div>
                                    <span>Fecha: {{$proyecto->created_at->format("d/m/Y")}}</span>
                                </div>
                            </div>
                        </a>
                    </div>
            @endforeach
            </div>
                {{ $proyectos["ids"]->links('pagination::bootstrap-4') }}
        @endif
    </div>
@endsection

