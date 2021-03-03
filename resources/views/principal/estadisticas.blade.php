@extends("layouts.principal.layoutPrincipal")

@section("titulo")
    <title>PlanTool - Principal</title>
@endsection

@section('css')
    <link href="/css/estadisticas.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.23.1/apexcharts.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.23.1/apexcharts.min.css">
@endsection

@section("contenido")
    <div class="container-fluid" id="contenedorPadre">
        <div class="col-12 col-xl-10 mx-auto" id="contenedorFormulario">
            <h1 class="m-0 pt-2 pb-2">Estadísticas</h1>
            <div class="datoest">
                <select name="estadistica" id="selector" class="w-50">
                    <option value="estado" selected>Estado</option>
                    <option value="periodo">Período</option>
                    <option value="permiso">Permiso</option>
                </select>
                <div-estadisticas></div-estadisticas>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        class DivEstadisticas extends HTMLElement {
            constructor() {
                super();
                this.innerHTML = "<div class='estadisticas'></div>";
            };
        };

        customElements.define('div-estadisticas', DivEstadisticas);
    </script>
    <script src="/js/estadisticas.js"></script>
@endsection
