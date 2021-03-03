@extends("layouts.principal.layoutPrincipal")

@section("titulo")
    <title>PlanTool - Proyectos</title>
@endsection

@section("css")
    <link href="/css/principal.css" rel="stylesheet" />
    <link href="/css/tablaProyectos.css" rel="stylesheet" />
    <link href="/css/paginacion.css" rel="stylesheet" />
@endsection

@section("contenido")
    <div class="container-fluid">
        @if(count($listaproyectos["proyectos"]) == 0)
            <div id="noProyectos">
                <h1 class="text-dark">No tienes proyectos!</h1>
                <p class="text-dark"><b>Únete mediante invitación o crea uno propio!</b></p>
            </div>
        @else
            <h1 class="mt-4 mt-xl-5 mb-xl-5 pt-xl-4">Mi lista de proyectos</h1>
        <table class="mt-xl-5">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th class="text-center">Coordinador</th>
                    <th class="text-center">Fecha de entrada</th>
                    <th class="text-right">Eliminar</th>
                </tr>
            </thead>
            <tbody>
            @foreach($listaproyectos["proyectos"] as $proyecto)
                <tr>
                    <td>{{$proyecto->titulo}}</td>
                    <td class="text-center">{{$proyecto->coordinador->usuario}}</td>
                    <td class="text-center">{{$proyecto->created_at->format("d/m/Y")}}</td>
                    <td class="text-right"><a href="#" onclick="aceptarDesvinculoEliminar({{$proyecto->id}})"><i class="fas fa-trash-alt"></i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
            {{ $listaproyectos["ids"]->onEachSide(0)->links('pagination::bootstrap-4') }}
        @endif
    </div>
@endsection

@section('script')

@endsection
