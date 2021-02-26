@extends("layouts.principal.layoutPrincipal")

@section("titulo")
    <title>PlanTool - Principal</title>
@endsection
@section('css')
    <link href="css/principal.css" rel="stylesheet" />
@endsection
@section("contenido")
    <div class="container">
        @if(count($proyectos) == 0)
            <div id="noProyectos">
                <h1>No tienes proyectos!</h1>
                <p>Únete mediante invitación o crea uno propio!</p>
            </div>
        @else
            <div id="proyectos">
                <div>
                    <a href="{{ route('proyecto','1') }}">
                        <div class="proyecto">
                            <h2>Titulo de ejemplo</h2>
                            <div>
                                <span>Creado por: ejemplo</span>
                            </div>
                            <div>
                                <p>Descripcion de ejemplo fjheaiuovnaeuicvneaucnie</p>
                            </div>
                            <div>
                                <span>Fecha: 24/02/2021</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div>
                    <a href="{{ route('proyecto','2') }}">
                        <div class="proyecto">
                            <h2>Titulo de ejemplo</h2>
                            <div>
                                <span>Creado por: ejemplo</span>
                            </div>
                            <div>
                                <p>Descripcion de ejemplo fjheaiuovnaeuicvneaucnie</p>
                            </div>
                            <div>
                                <span>Fecha: 24/02/2021</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div>
                    <a href="{{ route('proyecto','3') }}">
                        <div class="proyecto">
                            <h2>Titulo de ejemplo</h2>
                            <div>
                                <span>Creado por: ejemplo</span>
                            </div>
                            <div>
                                <p>Descripcion de ejemplo fjheaiuovnaeuicvneaucnie</p>
                            </div>
                            <div>
                                <span>Fecha: 24/02/2021</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div>
                    <a href="/proyecto/4">
                        <div class="proyecto">
                            <h2>Titulo de ejemplo</h2>
                            <div>
                                <span>Creado por: ejemplo</span>
                            </div>
                            <div>
                                <p>Descripcion de ejemplo fjheaiuovnaeuicvneaucnie</p>
                            </div>
                            <div>
                                <span>Fecha: 24/02/2021</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection

