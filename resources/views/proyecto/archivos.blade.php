@extends("layouts.principal.layoutPrincipal")

@section("titulo")
    <title>PlanTool - Proyecto</title>
@endsection

@section("css")
    <link href="css/archivo.css" rel="stylesheet" />
@endsection

@section("contenido")
    <div class="container-fluid">
        <div id="contenedorPadre">
            <div id="archivos">
                <div class="archivo">
                    <div>
                        <span class="autor">Ejemplo de autor</span>
                        <span>21/21/2021</span>
                    </div>
                    <div>
                        <a href="#">
                            <span>""""Icono del archivo""""""</span>
                            <span>Nombre del archivo</span>
                        </a>
                    </div>
                </div>
                <div class="archivo">
                    <div>
                        <span class="autor">Ejemplo de autor</span>
                        <span>21/21/2021</span>
                    </div>
                    <div>
                        <a href="#">
                            <span>""""Icono del archivo""""""</span>
                            <span>Nombre del archivo</span>
                        </a>
                    </div>
                </div>
                <div class="archivo">
                    <div>
                        <span class="autor">Ejemplo de autor</span>
                        <span>21/21/2021</span>
                    </div>
                    <div>
                        <a href="#">
                            <span>""""Icono del archivo""""""</span>
                            <span>Nombre del archivo</span>
                        </a>
                    </div>
                </div>
            </div>
            <div id="addArchivos">
                <form action="#" method="post">
                    <div id="contenedorBotones">
                        <div><label for="archivo"><button type="button">Añadir archivos</button></label> </div>
                        <div><button type="submit" id="botonEnviar">Enviar</button></div>
                    </div>

                    <input type="file" id="archivo" hidden>
                </form>
                <ul>
                    <li>Archivo 1 &nbsp&nbsp<span><i class="fas fa-times"></i></span></li>
                    <li>Archivo 1 &nbsp&nbsp<span><i class="fas fa-times"></i></span></li>
                    <li>Archivo 1 &nbsp&nbsp<span><i class="fas fa-times"></i></span></li>
                </ul>
            </div>
        </div>

    </div>
@endsection
