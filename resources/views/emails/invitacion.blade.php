<div>
    <h2>Has sido invitado para colaborar en el proyecto: {{$proyecto->titulo}}</h2>
    <h2>Creado por: {{$coordinador->usuario}}</h2>
    <p style="margin-bottom: 40px">¿Deseas colaborar en este proyecto?</p>
    <a href="{{$ruta}}/addIntegrante/{{base64_encode($usuario->id)}}/{{base64_encode($proyecto->id)}}" style="
    border: solid black 1px;
        padding: 10px 20px;
        background-color: green;
        color: white;
        text-decoration: none;
        margin-right: 20px;
        margin-bottom: 10px;
        ">
        Unirme
    </a>
    <p style="margin-top: 40px">Gracias por tu tiempo {{$usuario->nombre}} {{$usuario->apellidos}}</p>
</div>

