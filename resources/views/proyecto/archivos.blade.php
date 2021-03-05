@extends("layouts.principal.layoutPrincipal")

@section("titulo")
    <title>PlanTool - Proyecto</title>
@endsection

@section("css")
    <link href="/css/archivo.css" rel="stylesheet" />
    <link href="/css/tablaProyectos.css" rel="stylesheet" />
    <link href="/css/paginacion.css" rel="stylesheet" />
@endsection

@section("contenido")
    <div class="container-fluid">
        <div id="archivos" class="mb-4">
            @if(count($archivos) == 0)
                <div id="noArchivos">
                    <h1>No se han encontrado archivos del proyecto</h1>
                    @if($permiso == 1)
                        <p>Sube archivos del proyecto</p>
                    @else
                        <p>Espera a que el coordinador suba archivos del proyecto</p>
                    @endif
                </div>
            @else
                <h1 class="mt-5">Archivos del proyecto</h1>
                <table>
                    <thead>
                    <tr>
                        <th>Fecha de subida</th>
                        <th>Archivo</th>
                        <th style="text-align: end">Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($archivos as $archivo)
                        <tr>
                            <td>{{$archivo->created_at->format("d/m/Y")}}</td>
                            @if($archivo->extension == "pdf")
                                <td><a href="{{route("descargar",["hash" => $archivo->archivo_hash, "nombre" => $archivo->archivo_original])}}" style="color: black"><span class="mr-2" style="color: red"><i class='fas fa-file-pdf'></i></span>{{$archivo->archivo_original}}</a></td>
                            @else
                                <td><a href="{{route("descargar",["hash" => $archivo->archivo_hash, "nombre" => $archivo->archivo_original])}}" style="color: black"><span class="mr-2"><i class='fas fa-image'></i></span>{{$archivo->archivo_original}}</a></td>
                            @endif
                            @if($permiso == 1)
                            <td style="text-align: end"><a href="/eliminarArchivo/{{$archivo->id}}/{{$archivo->archivo_hash}}" onclick="eliminararchivoconfir(event)"><span><i class="fas fa-trash-alt" style="color: red"></i></span></a></td>
                           @else
                            <td style="text-align: end"><span><i class="fas fa-ban"></i></span></td>
                           @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        {{ $archivos->links('pagination::bootstrap-4') }}
        @if($permiso == 1)
        <hr>
        <div class="d-flex flex-column">
            <div id="formulario" class="mb-3">
                <form action="subirArchivos" method="post" enctype="multipart/form-data" onsubmit="return revisarExistenciaDeArchivos()">
                    @csrf
                    <div>
                        <label for="archivoChat" id="botonAddArchivo">Añadir archivos <i class="fas fa-paperclip ml-1"></i></label>
                        <button type="submit" class="subir">Subir <i class="fas fa-share ml-1"></i></button>
                    </div>
                    <input type="file" id="archivoChat" name="archivo" hidden>
                    <div id="enviarArchivos" class="h-100">
                        <p id="textoArchivosAdjuntos" class="text-center">Archivos adjuntos</p>
                        <ul id="listaArchivos">

                        </ul>
                    </div>
                    <div id="inputsHidden">

                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
@endsection

@section("script")
    <script src="/js/proyecto.js"></script>
@endsection
