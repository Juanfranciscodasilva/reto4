<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ControllerProyecto extends Controller
{
    public function entrar($id){
        return view("proyecto.proyecto")->with([
            "pagina" => "proyecto",
            "proyecto" => $id]
        );
    }

    public function eliminar($id){
        //TODO ELIMINAR PROYECTO
        return back();
    }
}
