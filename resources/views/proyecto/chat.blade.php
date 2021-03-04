@extends("layouts.principal.layoutPrincipal")

@section("titulo")
    <title>PlanTool - Proyecto</title>
@endsection

@section("css")
    <link href="/css/chat.css" rel="stylesheet" />
@endsection

@section("contenido")
    <div class="container-fluid">
        <div id="mensajes">
            @foreach($mensajes as $mensaje)
                @if($mensaje->autor->id == $idIniciado)
                    <div class="mensaje propio">
                @else
                    <div class="mensaje">
                @endif
                        <div class="mb-0">
                            @if($mensaje->autor->id == $idIniciado)
                                <span class="autor">Tú</span>
                            @else
                                <span class="autor">{{$mensaje->autor->usuario}}</span>
                            @endif

                            <span>{{$mensaje->created_at->format("d/m/Y - h:i a")}}</span>
                        </div>
                        @if($mensaje->autor->id == $idIniciado)
                            <div class="dropdown d-flex justify-content-end mb-0">
                                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu p-0" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item pt-2 pb-2" href="{{ route('eliminarmensaje',$mensaje->id) }}" onclick="eliminarmensaje(event)">Eliminar mensaje</a></li>
                                </ul>
                            </div>
                        @endif

                        <p class="descripcion m-0">{{$mensaje->comentario}}</p>

                        @if(count($mensaje->archivos) > 0)
                            <div class="mb-0">
                                <ul id="archivosMensaje">
                                @foreach($mensaje->archivos as $archivo)
                                        <li class="mr-5 bloqueArchivosMensaje">
                                            <a href="{{route("descargar",["hash" => $archivo->archivo_hash, "nombre" => $archivo->archivo_original])}}">
                                    @if($archivo->extension == "pdf")
                                        <span class="mr-1" style="color: red"><i class='fas fa-file-pdf'></i></span>
                                    @else
                                        <span class="mr-1"><i class='fas fa-image'></i></span>
                                    @endif
                                        {{$archivo->archivo_original}}
                                        <i class='fas fa-cloud-download-alt ml-1 iconoDescargar'></i>
                                            </a>
                                        </li>
                                @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
            @endforeach

        </div>
        <div id="publicar">
            <form action="{{route("crearComentario")}}" method="post" enctype="multipart/form-data" onsubmit="return enviarComentario()">
                @csrf
                <textarea name="mensaje" required maxlength="1000"></textarea>
                <label for="archivoChat" class="archivochat"><i class="fas fa-paperclip"></i></label>
                <input type="file" id="archivoChat" name="archivo" hidden>
                <button type="submit" class="subirarchi"><i class="fas fa-share"></i></button>
                <div id="inputsHidden">

                </div>
            </form>
        </div>
        <div id="archivos">
            <p id="textoArchivosAdjuntos">Archivos adjuntos</p>
            <ul id="listaArchivos">

            </ul>
        </div>
    </div>
@endsection

@section("script")
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    <script src="/js/proyecto.js">
@endsection
