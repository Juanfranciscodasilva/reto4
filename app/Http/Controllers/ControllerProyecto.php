<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ControllerProyecto extends Controller
{
    public function establecerID($id){
        Session::put("proyecto",$id);
        return redirect("/proyecto");
    }

    public function entrar(){
        if (!Session::exists("proyecto")){
            return redirect("/principal");
        }
        return view("proyecto.proyecto")->with("pagina","proyecto");
    }

    public function eliminar($id){
        //TODO ELIMINAR PROYECTO
        return back();
    }
}
