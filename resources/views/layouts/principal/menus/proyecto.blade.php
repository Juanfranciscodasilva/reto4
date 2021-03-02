@extends('layouts.principal.menus.estructuramenu',["menu" => '1'])

@section('menucont')
    <div class="sb-sidenav-menu-heading">Proyecto</div>

    <a class="nav-link" href="{{route("proyecto")}}">
        <div class="sb-nav-link-icon"><i class="fas fa-info"></i></div>
        Información general
    </a>
    @if($permiso != 'nointegrante')
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
            Tareas activas
        </a>
        <a class="nav-link" href="{{route("tareasFinalizadas")}}">
            <div class="sb-nav-link-icon"><i class="fas fa-clipboard-check"></i></div>
            Tareas finalizadas
        </a>
    @if($permiso)
        <a class="nav-link" href="{{route("crearTarea")}}">
            <div class="sb-nav-link-icon"><i class="fas fa-plus-circle"></i></div>
            Crear tarea
        </a>
    @endif
    <a class="nav-link" href="{{route("integrantes")}}">
        <div class="sb-nav-link-icon"><i class="fas fa-user-friends"></i></div>
        Integrantes
    </a>
    @endif
@endsection

