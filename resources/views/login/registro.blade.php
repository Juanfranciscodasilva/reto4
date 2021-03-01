@extends('layouts.login.login')

@section('contenido')
    <form id="formregist" method="post" action="{{ route('registrar.registro') }}" class="formu">
        @csrf
        <h1 class="titulo pb-1 w-75 text-center">Registro</h1>
        <div class="row w-75 mt-3">
            <div class="col-12 col-lg-6 text-lg-center">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control text-lg-center" id="nombre" name="nombre" pattern="^([A-Za-zÀ-ÿ]+[ ]?)+$" required value="{{ old('nombre') }}">
            </div>
            <div class="col-12 col-lg-6 mt-2 mt-lg-0 text-lg-center">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control text-lg-center" id="apellidos" name="apellidos" pattern="^([A-Za-zÀ-ÿ]+[ ]?)+$" required value="{{ old('apellidos') }}">
            </div>
            <div class="col-12 col-lg-6 mt-2 text-lg-center">
                <label for="usuario" class="form-label">Usuario</label>
                <input type="text" class="form-control text-lg-center" id="usuario" name="usuario" pattern="^[A-z.0-9]+$" required value="{{ old('usuario') }}">
            </div>
            <div class="col-12 col-lg-6 mt-2 text-lg-center">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control text-lg-center" id="email" name="email" required value="{{ old('email') }}">
            </div>
            <div class="col-12 col-lg-6 mt-2 text-lg-center">
                <label for="pass" class="form-label">Contraseña</label>
                <input type="password" class="form-control text-lg-center" value="{{ old('pass') }}" id="pass" name="pass" pattern="^[A-z0-9]+$" minlength="8" required>
            </div>
            <div class="col-12 col-lg-6 mt-2 text-lg-center">
                <label for="repass" class="form-label">Confirmar contraseña</label>
                <input type="password" class="form-control text-lg-center" name="repass" value="{{ old('repass') }}" id="repass" pattern="[A-z0-9]+$" minlength="8" required>
            </div>
            @include('layouts.error.errores')
            <div class="error">

            </div>
                <button type="submit" class="btn boton w-100 mt-2">Registrarse</button>
            </div>
        </div>
    </form>
@endsection

