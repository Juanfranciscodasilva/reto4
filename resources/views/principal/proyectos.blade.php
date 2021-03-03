@extends("layouts.principal.layoutPrincipal")

@section("titulo")
    <title>PlanTool - Proyectos</title>
@endsection

@section("css")
    <link href="/css/principal.css" rel="stylesheet" />
    <link href="/css/tablaProyectos.css" rel="stylesheet" />
@endsection

@section("contenido")
    <div class="container-fluid">
        @if(count($proyectos["proyectos"]) == 0)
            <div id="noProyectos">
                <h1 class="text-dark">No tienes proyectos!</h1>
                <p class="text-dark"><b>Únete mediante invitación o crea uno propio!</b></p>
            </div>
        @else
        <table>
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th class="text-center">Coordinador</th>
                    <th class="text-center">Fecha de entrada</th>
                    <th class="text-right">Eliminar</th>
                </tr>
            </thead>
            <tbody>
            @foreach($proyectos["proyectos"] as $proyecto)
                <tr>
                    <td>{{$proyecto->titulo}}</td>
                    <td class="text-center">{{$proyecto->coordinador->usuario}}</td>
                    <td class="text-center">{{$proyecto->created_at->format("d/m/Y")}}</td>
                    <td class="text-right"><a href="/eliminarProyecto/{{$proyecto->id}}"><i class="fas fa-trash-alt"></i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @endif
    </div>
@endsection
