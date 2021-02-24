<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ControllerPrincipal extends Controller
{
    public function entrar(){
        $proyectos = [0];
        if (Session::exists("usuario")){
            return view("principal.principal")->with("pagina","principal")->with("proyectos",$proyectos);
        }
        return redirect("/");

    }

    public function proyectos(){
        return view("principal.proyectos")->with("pagina","principal");
    }

    public function abrirCrearProyecto(){
        return view("principal.crearProyecto")->with("pagina","principal");
    }

    public function perfil(){
        return view("perfil.perfil")->with("pagina","perfil");
    }
}
