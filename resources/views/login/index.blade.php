@extends('layouts.login.login')
@section('contenido')
        <form action="{{route("iniciarSesion")}}" method="post">
            @csrf
            <h1 class="titulo pb-1 w-50 text-center">Iniciar Sesión</h1>
            <div class="row col-11 col-lg-7">
                @if($registrado)
                    <div class="text-center">
                        <div class="alert alert-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="mb-1 bi bi-check-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                            </svg>
                            <span class="ms-2">Usuario creado correctamente</span>
                        </div>
                    </div>
                @endif
                <div class="mb-3 text-lg-center">
                    <label for="exampleInputEmail1" class="form-label">Usuario o correo electrónico</label>
                    @if($usuario != "")
                        <input type="text" class="form-control text-lg-center" value="{{ $usuario }}" id="exampleInputEmail1" name="usuario" aria-describedby="emailHelp" required>
                    @else
                        <input type="text" class="form-control text-lg-center" id="exampleInputEmail1" name="usuario" aria-describedby="emailHelp" required>
                    @endif
                </div>
                <div class="mb-3 text-lg-center">
                    <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                    @if($password != "")
                        <input type="password" value="{{ $password }}" name="password" class="form-control text-lg-center" id="exampleInputPassword1" required>
                    @else
                        <input type="password" class="form-control text-lg-center" name="password" id="exampleInputPassword1" required>
                    @endif
                </div>
                @if(isset($error))
                   <div class="mt-2 text-center" role="alert">
                       <div class="alert alert-danger">
                           <span>{{ $error }}</span>
                       </div>
                   </div>
                @endif

                <div class="mt-2">
                    <button type="submit" class="btn boton w-100">Login</button>
                </div>
            </div>
        </form>
    @endsection

