@extends("layouts.layoutLogin")

@section("cuerpo")
    <!-- Cuerpo-->
    <header class="masthead">
        <div class="container">
            <form action="{{route("iniciarSesion")}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Usuario o correo electrónico</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="usuario" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                </div>
                <div>
                    <span>{{$error}}</span>
                </div>
                <button type="submit" class="btn btn-primary" id="botonIniciar">Login</button>
            </form>
        </div>
    </header>
@endsection

