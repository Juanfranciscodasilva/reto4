@extends('layouts.principal.menus.estructuramenu',["menu" => '2'])

@section('menucont')
    <div class="sb-sidenav-menu-heading">General</div>
        <a class="nav-link" href="{{route("proyectos")}}">
            <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
            Proyectos
        </a>
        <a class="nav-link" href="{{route("crear")}}">
            <div class="sb-nav-link-icon"><i class="fas fa-folder-plus"></i></div>
            Crear proyecto
        </a>
        <a class="nav-link" href="{{ route('principal') }}">
            <div class="sb-nav-link-icon"><i class="fas fa-envelope-open-text"></i></div>
            Contacto
        </a>
@endsection
