@extends("layouts.principal.layoutPrincipal")

@section("titulo")
    <title>PlanTool - Proyecto</title>
@endsection

@section("css")
    <link href="/css/tablaProyectos.css" rel="stylesheet" />
    <link href="/css/perfil.css" rel="stylesheet" />
    <link href="/css/integrantes.css" rel="stylesheet" />
@endsection

@section("contenido")
    <div class="container-fluid">
        <div id="integrantes">
            <h2>Integrantes</h2>
            <table>
                <thead>
                <tr>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Rol</th>
                    @if($permiso == 1)
                        <th class="text-right">Expulsar</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach($integrantes as $integrante)
                    <tr>
                        <td class="text-center">{{$integrante->usuario}}</td>
                        <td class="text-center">{{$integrante->email}}</td>
                        <td class="text-center">{{$integrante->rol}}</td>
                        @if($permiso == 1)
                            @if($integrante->rol == "Colaborador")
                            <td class="text-right"><a href="/expulsarIntegrante/{{$integrante->id}}"><i class="fas fa-trash-alt"></i></a></td>
                            @else
                                <td class="text-right"><i class="fas fa-ban"></i></td>
                            @endif
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @if($permiso == 1)
            <hr>
            <div class="mb-5">
                <h2>Añadir colaborador</h2>
                @if(count($usuariosNoPertenecientes) > 0)
                <table class="col-12 table_of_proyectos display compact stripe border-1 border-dark p-0">
                    <thead>
                    <tr class="text-dark">
                        <th class="pr-0">Usuario</th>
                        <th class="text-center pr-0">Email</th>
                        <th class="text-right pr-0">Invitar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($usuariosNoPertenecientes as $usuario)
                        <tr class="text-dark">
                            <td>{{$usuario->usuario}}</td>
                            <td class="text-center">{{$usuario->email}}</td>
                            <td class="text-right"><a href="/invitarIntegrante/{{$usuario->id}}" class="enlaceInvitar">Invitar</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @else
                    <p class="text-center"><b>No hay usuarios para invitar</b></p>
                @endif
            </div>
        @endif
    </div>
@endsection

@section("script")
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
    <script src="/js/tablaproyecto.js"></script>
@endsection
