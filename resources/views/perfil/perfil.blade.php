@extends("layouts.principal.layoutPrincipal")

@section("titulo")
    <title>PlanTool - Perfil</title>
@endsection
@section("css")
    <link href="css/perfil.css" rel="stylesheet" />
@endsection
@section("contenido")
    <div class="container-fluid mt-5 mb-5" id="contenedorPadre">
        <div class="col-12 mx-auto" id="contenedorFormulario">
            <h1 class="m-0 pt-2 pb-2">Mi Perfil</h1>
            <br />
            <div class="text-white datos row">
                <div class="col-12 col-md-4 mt-4">
                    <div class="imagen mx-auto">
                        <img src="/img/perfil/{{ \Illuminate\Support\Facades\Session::get('usuario')->imagen}}" class="w-100">
                    </div>
                    <div class="datos m-0 mt-2 text-center text-dark w-100">
                        <span><b>{{ \Illuminate\Support\Facades\Session::get('usuario')->nombre }} {{ \Illuminate\Support\Facades\Session::get('usuario')->apellidos }}</b></span>
                        <br />
                        <span>{{ \Illuminate\Support\Facades\Session::get('usuario')->usuario }}</span>
                        <br />
                        <span>{{ \Illuminate\Support\Facades\Session::get('usuario')->email }}</span>
                        <br />
                        <button class="mt-2 perfil">Editar perfil</button>
                    </div>
                </div>
                <div class="tablapro col-md-8 mt-4 mt-xl-0">
                    <button class="float-right boton">Crear</button>
                        @if(count($listaproyectos) > 0)
                            <table class="col-12 table_of_proyectos display compact stripe border-1 border-dark p-0">
                                <thead>
                                    <tr class="text-white">
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                @foreach ($listaproyectos as $proyectos)
                                    <tbody>
                                        <tr class="text-dark">
                                            <td><b>{{ $proyectos->titulo }}</b></td>
                                            <td><b>{{ $proyectos->created_at->diffForHumans() }}</b></td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                            @else
                                <table class="col-12 noproy">
                                    <tr class="nopro">
                                        <th class="text-center text-dark">No hay proyectos en la lista</th>
                                    </tr>
                                </table>
                        @endisset
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
    <script src="/js/tablaproyecto.js"></script>
@endsection
