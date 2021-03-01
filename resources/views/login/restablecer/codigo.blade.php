@extends('layouts.login.login')

@section('contenido')
    <form method="post" action="{{ route('restablecercontra.codigo') }}" class="formu">
        @csrf
        <h1 class="titulo pb-1 w-75 text-center">Código de verificación</h1>
        <div class="row col-11 col-sm-9 mt-3">
            <div class="text-sm-center">
                <label for="codigo" class="form-label">Introduce el código de verificación</label>
                <input type="text" class="form-control text-sm-center" id="codigo" name="codigo" pattern="^[0-9]+$" required maxlength="5">
                @if(isset($error))
                    <div class="mt-3 text-center" role="alert">
                        <div class="alert alert-danger">
                            <span>{{ $error }}</span>
                        </div>
                    </div>
                    <button type="submit" class="btn boton mb-2 w-100">Verificar código</button>
                    <a href="{{ route('restablecercontra.reenviar') }}" class="w-100"><b>No recibí el código</b></a>
                @else
                    <button type="submit" class="btn boton w-100 mb-2 mt-4">Verificar código</button>
                    <a href="{{ route('restablecercontra.reenviar') }}" class="w-100"><b>No recibí el código</b></a>
                @endif

            </div>
        </div>
    </form>
@endsection

