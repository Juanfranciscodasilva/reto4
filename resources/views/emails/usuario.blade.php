<p>Hola {{ \Illuminate\Support\Facades\Session::get('usuario')->nombre }}, hemos recibido tu mensaje. Un supervisor se pondrá en contacto contigo en las siguientes 48 horas.</p>

<div>
    <h4>Mensaje</h4>
    <span>{{ $mensaje }}</span>
</div>
<br />
<br />
<small>Esto es un mensaje automatico, por favor no responda a este correo.</small>
