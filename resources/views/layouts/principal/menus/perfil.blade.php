@extends('layouts.principal.menus.estructuramenu',["menu" => '3'])

@section('menucont')
    @if($usuarioreal == "")
        <div class="sb-sidenav-menu-heading">Perfil</div>
            <a class="nav-link" href="{{route("perfil")}}">
                <div class="sb-nav-link-icon"><i class="fas fa-address-book"></i></div>
                Mi Perfil
            </a>
            <a class="nav-link" href="{{route("modificarcontra.index")}}">
                <div class="sb-nav-link-icon"><i class="fas fa-key"></i></div>
                Modificar Contraseña
            </a>
            <a class="nav-link" href="{{route("modificarperfil.index")}}">
                <div class="sb-nav-link-icon"><i class="fas fa-user-edit"></i></div>
                Editar Perfil
            </a>
            <a class="nav-link" href="#" onclick="eliminarusuario()">
                <div class="sb-nav-link-icon"><i class="fas fa-user-times"></i></div>
                Eliminar Usuario
            </a>
    @endif
    <a class="nav-link" href="{{ route('login.home') }}">
        <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
        Cerrar Sesión
    </a>
@endsection
