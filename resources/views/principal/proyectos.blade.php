@extends("layouts.principal.layoutPrincipal")

@section("titulo")
    <title>PlanTool - Proyectos</title>
@endsection

@section("css")
    <link href="css/tablaProyectos.css" rel="stylesheet" />
@endsection

@section("contenido")
    <div class="container-fluid">
        <table>
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Coordinador</th>
                    <th>Fecha de entrada</th>
                    <th class="text-right">Eliminar</th>
                </tr>
            </thead>
            <tbody>
            @foreach($proyectos["proyectos"] as $proyecto)
                <tr>
                    <td>{{$proyecto->titulo}}</td>
                    <td>{{$proyecto->coordinador->usuario}}</td>
                    <td>{{$proyecto->created_at->format("d/m/Y")}}</td>
                    <td class="text-right"><a href="/eliminarProyecto/{{$proyecto->id}}"><i class="fas fa-trash-alt"></i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
