@extends('layouts.login.login')

@section('contenido')
    <form id="formregist" method="post" action="{{ route('restablecercontra.contra') }}" class="formu">
        @csrf @method('PATCH')
        <h1 class="titulo pb-1 w-75 text-center">Modificar contraseña</h1>
        <div class="row col-11 col-sm-9 mt-3">
            <div class="text-sm-center">
                <label for="pass" class="form-label">Contraseña nueva</label>
                <input type="password" class="form-control text-sm-center" id="pass" name="pass" pattern="^[A-z0-9]+$" required minlength="8">
                <label for="repass" class="form-label mt-3">Confirmar contraseña</label>
                <input type="password" class="form-control text-sm-center mb-3" id="repass" name="repass" pattern="^[A-z0-9]+$" required minlength="8">
                <div class="error mt-1">

                </div>
                <button type="submit" class="btn boton w-100 mb-2 mt-2">Modificar contraseña</button>
            </div>
        </div>
    </form>
@endsection

