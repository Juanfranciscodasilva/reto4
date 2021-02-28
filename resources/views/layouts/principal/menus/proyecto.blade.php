@extends('layouts.principal.menus.estructuramenu',["menu" => '1'])

@section('menucont')
    <div class="sb-sidenav-menu-heading">Proyecto</div>
    <a class="nav-link" href="#">
        <div class="sb-nav-link-icon"><i class="fas fa-comment-dots"></i></div>
        Chat
    </a>
    <a class="nav-link" href="#">
        <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list"></i></div>
        Mis tareas
    </a>
    <a class="nav-link" href="#">
        <div class="sb-nav-link-icon"><i class="fas fa-user-friends"></i></div>
        Integrantes
    </a>
@endsection

