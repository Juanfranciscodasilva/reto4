@extends('layouts.login.login')

@section('contenido')
    <form method="post" action="{{ route('restablecercontra.email') }}" class="formu">
        @csrf
        <h1 class="titulo pb-1 w-75 text-center">Restablecer contraseña</h1>
        <div class="row col-11 col-sm-9 mt-3">
            <div class="text-sm-center">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control text-sm-center" id="email" name="email" required>
                @if(isset($error))
                    <div class="mt-3 text-center" role="alert">
                        <div class="alert alert-danger">
                            <span>{{ $error }}</span>
                        </div>
                    </div>
                    <button type="submit" class="btn boton w-100">Obtener una nueva contraseña</button>
                @else
                    <button type="submit" class="btn boton w-100 mt-4">Obtener una nueva contraseña</button>
                @endif

            </div>
        </div>
    </form>
@endsection
