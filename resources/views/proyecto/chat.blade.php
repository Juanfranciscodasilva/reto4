@extends("layouts.principal.layoutPrincipal")

@section("titulo")
    <title>PlanTool - Proyecto</title>
@endsection

@section("css")
    <link href="css/chat.css" rel="stylesheet" />
@endsection

@section("contenido")
    <div class="container-fluid">
        <div id="mensajes">
            @if(count($mensajes) == 0)
            @else
            @endif
            @foreach($mensajes as $mensaje)
                @if($mensaje->autor->id == $idIniciado)
                    <div class="mensaje propio">
                @else
                    <div class="mensaje">
                @endif
                        <div>
                            @if($mensaje->autor->id == $idIniciado)
                                <span class="autor">Tú</span>
                            @else
                                <span class="autor">{{$mensaje->autor->usuario}}</span>
                            @endif

                            <span>{{$mensaje->created_at->format("d/m/Y - h:i a")}}</span>
                        </div>
                        <p class="descripcion">{{$mensaje->comentario}}</p>
                        @if(count($mensaje->archivos) > 0)
                            <div>
                                <p>archivos</p>
                            </div>
                        @endif
                    </div>
            @endforeach

        </div>
        <div id="publicar">
            <form action="{{route("crearComentario")}}" method="post" enctype="multipart/form-data" onsubmit="return enviarComentario()">
                @csrf
                <textarea name="mensaje" required maxlength="1000"></textarea>
                <label for="archivoChat"><i class="fas fa-paperclip"></i></label>
                <input type="file" id="archivoChat" name="archivo" hidden>
                <button type="submit"><i class="fas fa-share"></i></button>
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
    <script src="/js/proyecto.js">
@endsection
