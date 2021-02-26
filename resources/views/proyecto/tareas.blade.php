@extends("layouts.principal.layoutPrincipal")

@section("titulo")
    <title>PlanTool - Proyecto</title>
@endsection

@section("css")
    <link href="/css/tareas.css" rel="stylesheet" />
@endsection

@section("contenido")
    <div class="container">
        <h1>Tareas asignadas</h1>
        <div id="tareas">
            <div class="tarea">
                <h2>Titulo</h2>
                <p>Descripcion</p>
                <div>
                    <span>Fecha límite: 22/22/2021</span>
                    <span>Estado: Asignada</span>
                </div>
                <form action="#" method="post">
                    <input type="hidden" value="idtarea">
                    <button type="submit">Finalizar</button>
                </form>
            </div>
            <div class="tarea">
                <h2>Titulo</h2>
                <p>Descripcion</p>
                <div>
                    <span>Fecha límite: 22/22/2021</span>
                    <span>Estado: Asignada</span>
                </div>
                <form action="#" method="post">
                    <input type="hidden" value="idtarea">
                    <button type="submit">Finalizar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
