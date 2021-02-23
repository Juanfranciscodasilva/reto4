<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerPrincipal extends Controller
{
    public function entrar(){
        return view("layouts.layoutPrincipal")->with("pagina","principal");
    }
}
