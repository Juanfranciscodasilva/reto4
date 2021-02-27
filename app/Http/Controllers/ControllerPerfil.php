<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class ControllerPerfil extends Controller
{
    public function perfil(){
        $proyectos = Proyecto::all();

        return view("perfil.perfil")->with(
            [
                "pagina" => "perfil",
                "listaproyectos" => $proyectos
            ]);
    }
}
