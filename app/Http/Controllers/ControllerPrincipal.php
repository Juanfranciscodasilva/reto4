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
}
