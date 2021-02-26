<?php

namespace App\Http\Controllers;

use App\Models\Integrante;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ControllerProyecto extends Controller
{
    public function establecerID($id){
        Session::put("proyecto",$id);
        return redirect("/chat");
    }

    public function chat(){
        if (!Session::exists("proyecto")){
            return redirect("/principal");
        }
        $permiso = $this->obtenerPermiso();
        return view("proyecto.proyecto")->with([
            "pagina" => "proyecto",
            "coordinador" => $permiso
        ]);
    }

    public function tareas(){
        $permiso = $this->obtenerPermiso();
        return view("proyecto.tareas")->with([
            "pagina" => "proyecto",
            "coordinador" => $permiso
        ]);
    }

    public function integrantes(){
        $permiso = $this->obtenerPermiso();
        return view("proyecto.integrantes")->with([
            "pagina" => "proyecto",
            "coordinador" => $permiso
        ]);
    }

    public function eliminar($id){
        $proyecto = Proyecto::find($id);
        $proyecto->delete();
        return back();
    }

    public function crear(){

        \request()->validate([
           "titulo" => "unique:proyectos,titulo"
        ],[
            "titulo.unique" => 'El titulo "'.\request("titulo").'" no está disponible'
        ]);

        Proyecto::create([
           "titulo" =>  \request("titulo"),
            "descripcion" => \request("descripcion")
        ]);

        $proyecto = Proyecto::get()->where("titulo",\request("titulo"))->first();
        $usuario = Session::get("usuario");

        Integrante::create([
           "usuario" => $usuario->id,
           "proyecto" => $proyecto->id,
           "permiso" => true
        ]);

        return redirect("principal");

    }

    public function obtenerPermiso(){
        $usuario = Session::get("usuario");
        $proyecto = Session::get("proyecto");
        $proyecto = Proyecto::find($proyecto);
        $permiso = Integrante::get()->where("usuario",$usuario->id)->where("proyecto",$proyecto->id)->first();
        return $permiso->permiso;
    }

    public function crearTarea(){
        $permiso = $this->obtenerPermiso();
        return view("proyecto.crearTarea")->with([
            "pagina" => "proyecto",
            "coordinador" => $permiso
        ]);
    }
}
