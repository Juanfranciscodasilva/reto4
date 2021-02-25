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
                    <th>Fecha de entrada</th>
                    <th class="text-right">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Proyecto de ejemplo</td>
                    <td>24/02/2021</td>
                    <td class="text-right"><a href="/eliminarProyecto/1"><i class="fas fa-trash-alt"></i></a></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
