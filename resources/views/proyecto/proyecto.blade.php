@extends("layouts.principal.layoutPrincipal")

@section("titulo")
    <title>PlanTool - Proyecto</title>
@endsection

@section("css")
    <link href="css/chat.css" rel="stylesheet" />
@endsection

@section("contenido")
    <div class="container-fluid">
        <div id="mensajes">
            <div class="mensaje">
                <div>
                    <span class="autor">Ejemplo de autor</span>
                    <span>21/21/2021</span>
                </div>
                <p class="descripcion">descripcion de ejemplo</p>
            </div>
            <div class="mensaje">
                <div>
                    <span class="autor">Ejemplo de autor</span>
                    <span>21/21/2021</span>
                </div>
                <span>""""Icono del archivo""""""</span>
                <span><a href="#">Nombre del archivo</a></span>
            </div>
            <div class="mensaje">
                <div>
                    <span class="autor">Ejemplo de autor</span>
                    <span>21/21/2021</span>
                </div>
                <p class="descripcion">descripcion de ejemplo</p>
            </div>
            <div class="mensaje">
                <div>
                    <span class="autor">Ejemplo de autor</span>
                    <span>21/21/2021</span>
                </div>
                <p class="descripcion">descripcion de ejemplo</p>
            </div>
            <div class="mensaje">
                <div>
                    <span class="autor">Ejemplo de autor</span>
                    <span>21/21/2021</span>
                </div>
                <p class="descripcion">descripcion de ejemplo</p>
            </div>
            <div class="mensaje">
                <div>
                    <span class="autor">Ejemplo de autor</span>
                    <span>21/21/2021</span>
                </div>
                <p class="descripcion">descripcion de ejemplo</p>
            </div>
            <div class="mensaje">
                <div>
                    <span class="autor">Ejemplo de autor</span>
                    <span>21/21/2021</span>
                </div>
                <p class="descripcion">descripcion de ejemplo</p>
            </div>
            <div class="mensaje">
                <div>
                    <span class="autor">Ejemplo de autor</span>
                    <span>21/21/2021</span>
                </div>
                <p class="descripcion">descripcion de ejemplo</p>
            </div>
            <div class="mensaje">
                <div>
                    <span class="autor">Ejemplo de autor</span>
                    <span>21/21/2021</span>
                </div>
                <p class="descripcion">descripcion de ejemplo</p>
            </div>
            <div class="mensaje">
                <div>
                    <span class="autor">Ejemplo de autor</span>
                    <span>21/21/2021</span>
                </div>
                <p class="descripcion">descripcion de ejemplo</p>
            </div>
            <div class="mensaje">
                <div>
                    <span class="autor">Ejemplo de autor</span>
                    <span>21/21/2021</span>
                </div>
                <p class="descripcion">descripcion de ejemplo</p>
            </div>
            <div class="mensaje">
                <div>
                    <span class="autor">Ejemplo de autor</span>
                    <span>21/21/2021</span>
                </div>
                <p class="descripcion">descripcion de ejemplo</p>
            </div>
            <div class="mensaje">
                <div>
                    <span class="autor">Ejemplo de autor</span>
                    <span>21/21/2021</span>
                </div>
                <p class="descripcion">descripcion de ejemplo</p>
            </div>
            <div class="mensaje">
                <div>
                    <span class="autor">Ejemplo de autor</span>
                    <span>21/21/2021</span>
                </div>
                <p class="descripcion">descripcion de ejemplo</p>
            </div>
            <div class="mensaje">
                <div>
                    <span class="autor">Ejemplo de autor</span>
                    <span>21/21/2021</span>
                </div>
                <p class="descripcion">descripcion de ejemplo</p>
            </div>
            <div class="mensaje">
                <div>
                    <span class="autor">Ejemplo de autor</span>
                    <span>21/21/2021</span>
                </div>

                <p class="descripcion">descripcion de ejemplo</p>
            </div>

        </div>
        <div id="publicar">
            <form action="#" method="post">
                @csrf
                <textarea name="mensaje"></textarea>
                <label for="archivo"><i class="fas fa-paperclip"></i></label>
                <input type="file" id="archivo" name="archivo" hidden>
                <button type="submit"><i class="fas fa-share"></i></button>
            </form>

        </div>
    </div>
@endsection
