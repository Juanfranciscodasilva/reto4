@extends('layouts.login.login')

@section('contenido')
    <form method="post" action="{{ route('registrar.registro') }}">
        <h1 class="titulo pb-1 w-50 text-center">Restablecer contraseña</h1>
        <div class="row w-75">
            <div class="col-12">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control text-lg-center" id="email" name="email" required>
            </div>
            <button type="submit" class="btn boton w-100">Obtener una nueva contraseña</button>
        </div>
    </form>
@endsection
