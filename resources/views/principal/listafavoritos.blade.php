@extends("layouts.principal.layoutPrincipal")

@section("titulo")
    <title>PlanTool - Proyecto</title>
@endsection

@section("css")
    <link href="/css/tablaProyectos.css" rel="stylesheet" />
    <link href="/css/perfil.css" rel="stylesheet" />
    <link href="/css/listafavoritos.css" rel="stylesheet" />
@endsection

@section("contenido")
    <div class="container-fluid">
        <h2>Añadir colaborador</h2>
            <table class="col-12 table_of_proyectos display compact stripe border-1 border-dark p-0">
                <thead>
                    <tr class="text-dark">
                        <th class="pr-0 text-center">Titulo</th>
                        <th class="text-center pr-0">Favoritos</th>
                        <th class="text-center pr-0">Elimar</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($listaproyectos as $proyecto)
                    <tr class="text-dark">
                        <td class="text-center">{{ $proyecto->titulo }}</td>
                        <td class="text-center">{{ $proyecto->contadorfav }}</td>
                        <td class="text-center"><a href="/eliminarlistfav/{{ $proyecto->id }}" class="enlacefavorito"><i class="fas fa-star"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
             </table>
    </div>
@endsection

@section("script")
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
    <script src="/js/tablaproyecto.js"></script>
@endsection
