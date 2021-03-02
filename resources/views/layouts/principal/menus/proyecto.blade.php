@extends('layouts.principal.menus.estructuramenu',["menu" => '1'])

@section('menucont')
    <div class="sb-sidenav-menu-heading">Proyecto</div>

    <a class="nav-link" href="{{route("proyecto")}}">
        <div class="sb-nav-link-icon"><i class="fas fa-info"></i></div>
        Información general
    </a>
    <a class="nav-link" href="{{route("archivos")}}">
        <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
        Archivos
    </a>
    @if($permiso != 'nointegrante')
        <a class="nav-link" href="{{route("chat")}}">
            <div class="sb-nav-link-icon"><i class="fas fa-comment-dots"></i></div>
            Chat
        </a>
        <a class="nav-link" href="{{route("tareasActivas")}}">
            <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list"></i></div>
            Tareas activas
        </a>
        <a class="nav-link" href="{{route("tareasFinalizadas")}}">
            <div class="sb-nav-link-icon"><i class="fas fa-clipboard-check"></i></div>
            Tareas finalizadas
        </a>
        <a class="nav-link" href="{{route("integrantes")}}">
            <div class="sb-nav-link-icon"><i class="fas fa-user-friends"></i></div>
            Integrantes
        </a>
        @if($permiso)
            <a class="nav-link" href="{{route("crearTarea")}}">
                <div class="sb-nav-link-icon"><i class="fas fa-plus-circle"></i></div>
                Crear tarea
            </a>
            <a class="nav-link" href="{{route("crearTarea")}}">
                <div class="sb-nav-link-icon"><svg style="margin-bottom: 3px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder-x" viewBox="0 0 16 16">
                        <path d="M.54 3.87L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181L15.546 8H14.54l.265-2.91A1 1 0 0 0 13.81 4H2.19a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91H9v1H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zm6.339-1.577A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z"/>
                        <path d="M11.854 10.146a.5.5 0 0 0-.708.708L12.293 12l-1.147 1.146a.5.5 0 0 0 .708.708L13 12.707l1.146 1.147a.5.5 0 0 0 .708-.708L13.707 12l1.147-1.146a.5.5 0 0 0-.708-.708L13 11.293l-1.146-1.147z"/>
                    </svg></div>
                Eliminar proyecto
            </a>
        @else
            <a class="nav-link" href="{{route("crearTarea")}}">
                <div class="sb-nav-link-icon"><svg style="margin-bottom: 3px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder-x" viewBox="0 0 16 16">
                        <path d="M.54 3.87L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181L15.546 8H14.54l.265-2.91A1 1 0 0 0 13.81 4H2.19a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91H9v1H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zm6.339-1.577A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z"/>
                        <path d="M11.854 10.146a.5.5 0 0 0-.708.708L12.293 12l-1.147 1.146a.5.5 0 0 0 .708.708L13 12.707l1.146 1.147a.5.5 0 0 0 .708-.708L13.707 12l1.147-1.146a.5.5 0 0 0-.708-.708L13 11.293l-1.146-1.147z"/>
                    </svg></div>
                Desvincular proyecto
            </a>
        @endif
    @else
        <a class="nav-link" href="{{route("crearTarea")}}">
            <div class="sb-nav-link-icon"><i class="fas fa-user-plus"></i></div>
            Solicitar unirse
        </a>
    @endif
@endsection

