@extends('layouts.principal.menus.estructuramenu',["menu" => '1'])

@section('menucont')
    <div class="sb-sidenav-menu-heading">Proyecto</div>

    <a class="nav-link" href="{{route("proyecto")}}">
        <div class="sb-nav-link-icon"><i class="fas fa-info"></i></div>
        Información General
    </a>
    @if($permiso != 2)
        <a class="nav-link" href="{{route("archivos")}}">
            <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
            Archivos
        </a>
        <a class="nav-link" href="{{route("chat")}}">
            <div class="sb-nav-link-icon"><i class="fas fa-comment-dots"></i></div>
            Chat
        </a>
        <a class="nav-link" href="{{route("tareasActivas")}}">
            <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list"></i></div>
            Tareas Activas
        </a>
        <a class="nav-link" href="{{route("tareasFinalizadas")}}">
            <div class="sb-nav-link-icon"><i class="fas fa-clipboard-check"></i></div>
            Tareas Finalizadas
        </a>
        <a class="nav-link" href="{{route("integrantes")}}">
            <div class="sb-nav-link-icon"><i class="fas fa-user-friends"></i></div>
            Integrantes
        </a>
        @if($permiso == 1)
            <a class="nav-link" href="{{route("crearTarea")}}">
                <div class="sb-nav-link-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-plus" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z"/>
                        <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                        <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
                    </svg></div>
                Crear Tarea
            </a>
            <a class="nav-link" href="{{route("modificarproyecto")}}">
                <div class="sb-nav-link-icon"><i class="fas fa-edit"></i></div>
                Modificar Proyecto
            </a>
            <a class="nav-link" href="#" onclick="aceptarDesvinculoEliminar({{\Illuminate\Support\Facades\Session::get("proyecto")}})">
                <div class="sb-nav-link-icon"><svg style="margin-bottom: 3px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder-x" viewBox="0 0 16 16">
                        <path d="M.54 3.87L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181L15.546 8H14.54l.265-2.91A1 1 0 0 0 13.81 4H2.19a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91H9v1H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zm6.339-1.577A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z"/>
                        <path d="M11.854 10.146a.5.5 0 0 0-.708.708L12.293 12l-1.147 1.146a.5.5 0 0 0 .708.708L13 12.707l1.146 1.147a.5.5 0 0 0 .708-.708L13.707 12l1.147-1.146a.5.5 0 0 0-.708-.708L13 11.293l-1.146-1.147z"/>
                    </svg></div>
                Eliminar Proyecto
            </a>
        @else
            <a class="nav-link" href="#" onclick="aceptarDesvinculoEliminar({{\Illuminate\Support\Facades\Session::get("proyecto")}})">
                <div class="sb-nav-link-icon"><svg style="margin-bottom: 3px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder-x" viewBox="0 0 16 16">
                        <path d="M.54 3.87L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181L15.546 8H14.54l.265-2.91A1 1 0 0 0 13.81 4H2.19a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91H9v1H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zm6.339-1.577A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z"/>
                        <path d="M11.854 10.146a.5.5 0 0 0-.708.708L12.293 12l-1.147 1.146a.5.5 0 0 0 .708.708L13 12.707l1.146 1.147a.5.5 0 0 0 .708-.708L13.707 12l1.147-1.146a.5.5 0 0 0-.708-.708L13 11.293l-1.146-1.147z"/>
                    </svg></div>
                Desvincular Proyecto
            </a>
        @endif
    @else
        @if(!$estado)
            <a class="nav-link" href="{{route("archivos")}}">
                <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                Archivos
            </a>
            <a class="nav-link" href="{{route("integrantes")}}">
                <div class="sb-nav-link-icon"><i class="fas fa-user-friends"></i></div>
                Integrantes
            </a>
        @endif
        <a class="nav-link" href="{{route("solicitarunirse")}}">
            <div class="sb-nav-link-icon"><i class="fas fa-user-plus"></i></div>
            Solicitar unirse
        </a>
    @endif
@endsection

