@extends("layouts.principal.layoutPrincipal")

@section("titulo")
    <title>PlanTool - Perfil</title>
@endsection
@section("css")
    <link href="/css/perfil.css" rel="stylesheet" />
@endsection
@section("contenido")
    <div class="container-fluid mt-5 mb-5" id="contenedorPadre">
        <div class="col-12 mx-auto" id="contenedorFormulario">
            @if($usuarioreal == "")
                <h1 class="m-0 pt-2 pb-2">Mi Perfil</h1>
            @else
                <h1 class="m-0 pt-2 pb-2">Perfil de {{ $usuarioreal }}</h1>
            @endif
            <br />
            <div class="text-white datos row">
                <div class="col-7 mx-auto col-md-3">
                    @if($usuarioreal == "")
                        <div class="c-img mb-2 mt-0 mx-auto">
                            <img src="/img/perfil/{{ \Illuminate\Support\Facades\Session::get('usuario')->imagen}}">
                                <form id="formimagen" action="{{ route('modificarimagen') }}" enctype="multipart/form-data" method="post" class="txt col-12">
                                    @csrf @method('PATCH')
                                    <div>
                                        <label for="foto"><i class="fas fa-edit"></i></label>
                                        <input type="file" name="foto" id="foto" class="d-none" accept="image/jpeg,image/png,image/jpg">
                                    </div>
                                </form>
                        </div>
                    @else
                        <div class="c-img mb-2 mt-0 mx-auto">
                            <img src="/img/perfil/{{ \Illuminate\Support\Facades\Session::get('usuarioperfil')->imagen}}">
                        </div>
                    @endif
                    <div class="datos m-0 mt-4 text-center text-dark w-100">
                        @if($usuarioreal == "")
                            @include('layouts.perfil.perfilusu',['usuario' => 'usuario'])
                            <button class="mt-2 perfil">Editar perfil</button>
                        @else
                            @include('layouts.perfil.perfilusu',['usuario' => 'usuarioperfil'])
                        @endif

                    </div>
                </div>
                <div class="d-none d-sm-block col-md-8 mt-4 mt-xl-0 mx-auto">
                    <a href="{{ route('crear') }}"><button class="float-right boton">Crear</button></a>
                        @if(count($listaproyectos) > 0)
                            <table class="col-12 table_of_proyectos display compact stripe border-1 border-dark p-0">
                                <thead>
                                    <tr class="text-dark">
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listaproyectos as $proyectos)
                                        <tr class="text-dark" id="{{ $proyectos->id }}" onclick="mostrarproyecto(this)">
                                            <td>{{ $proyectos->titulo }}</td>
                                            <td class="fecha">{{ $proyectos->created_at->diffForHumans() }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
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
    @if($passCambiada)
        <script>
            alert('Contraseña modificada correctamente');
        </script>
    @endif
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
    <script src="/js/tablaproyecto.js"></script>
    <script src="/js/perfil.js"></script>
@endsection
