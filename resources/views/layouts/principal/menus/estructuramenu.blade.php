<a class="nav-link" href="{{ route('principal') }}">
    <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
    Inicio
</a>

@yield('menucont')
    @if($menu != '3')
        <div class="sb-sidenav-menu-heading">Perfil</div>
            <a class="nav-link" href="{{route("perfil")}}">
                <div class="sb-nav-link-icon"><i class="fas fa-address-book"></i></div>
                Perfil
            </a>
            <a class="nav-link" href="/">
                <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                Cerrar sesión
            </a>
    @endif
