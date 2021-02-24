<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ControllerLogin extends Controller
{

    public function entrar(){
        Session::remove("usuario");
        return view("login.index")->with("seleccionado",0)->with("error","");
    }

    public function iniciarSesion(){
        $usuario = \request("usuario");
        $pass = \request("password");


        $busqueda = Usuario::get()->where("usuario",$usuario)->where("password",$pass);

        if (count($busqueda)==0){
            //BUSCAR POR CORREO SI NO SE HA ENCONTRADO BUSCANDO POR USUARIO
            $busqueda = Usuario::get()->where("email",$usuario)->where("password",$pass);
            if (count($busqueda)==0){
                return view("index")->with("seleccionado",0)->with("error","Usuario o contraseña incorrecto/a");
            }
        }
            //TODO GUARDAR USUARIO EN SESION
            Session::put('usuario',$busqueda[0]);
            return redirect("principal");

    }

    public function registrar(){
        //TODO VALIDAR DATOS

        //TODO INSERTARLO

        Usuario::create([
           //COLUMNAS
        ]);
    }
}
