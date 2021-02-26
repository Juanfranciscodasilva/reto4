@extends("layouts.principal.layoutPrincipal")

@section("titulo")
    <title>PlanTool - Proyecto</title>
@endsection

@section("css")
    <link href="/css/tablaProyectos.css" rel="stylesheet" />
    <link href="/css/integrantes.css" rel="stylesheet" />
@endsection

@section("contenido")
    <div class="container">
        <div id="integrantes">
            <table>
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Juan Da Silva</td>
                    <td>juanfrancisco.dasilva@ikasle.egibide.org</td>
                    <td>Coordinador</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
