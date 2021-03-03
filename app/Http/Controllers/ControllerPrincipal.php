<?php

namespace App\Http\Controllers;

use App\Models\Integrante;
use App\Models\Proyecto;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ControllerPrincipal extends Controller
{
    public function entrar(){
        if (Session::exists("usuario")){
            $proyectos = $this->obtenerProyectos(6);
            return view("principal.principal")->with([
                "pagina" => "principal",
                "proyectos" => count($proyectos["proyectos"]),
                "listaproyectos" => $proyectos
            ]);
        }
        return redirect("/");
    }

    public function proyectos(){

        $proyectos = $this->obtenerProyectos(6);
        return view("principal.proyectos")->with([
            "pagina" => "principal",
            "proyectos" => count($proyectos["proyectos"]),
            "listaproyectos" => $proyectos
        ]);
    }

    public function abrirCrearProyecto(){
        $proyectos = $this->obtenerProyectos(0);
        return view("principal.crearProyecto")->with([
            "pagina" =>"principal",
            "proyectos" => count($proyectos["proyectos"])
        ]);
    }

    public function perfil(){
        return view("perfil.perfil")->with("pagina","perfil");
    }

    public function obtenerProyectos($paginacion){
        $proyectos = [];
        $usuario = Session::get("usuario")->id;
        $ids = [];

        if ($paginacion == 0){
            $ids = Integrante::get()->where("usuario",$usuario);
        }else{
            $ids = Integrante::where("usuario",$usuario)->paginate($paginacion);
        }

        foreach ($ids as $id){
            $proyecto = Proyecto::find($id->proyecto);
            $idCoordinador = Integrante::get()->where("proyecto",$id->proyecto)->where("permiso",true)->first();
            $coordinador = Usuario::find($idCoordinador->usuario);
            $proyecto->coordinador = $coordinador;
            array_push($proyectos,$proyecto);
        }
        $datosProyectos = [
            "proyectos" => $proyectos,
            "ids" => $ids
        ];

        return $datosProyectos;
    }

    public function vistaest(){
        $proyectos = $this->obtenerProyectos(0);
        return view('principal.estadisticas')->with(
            [
                'pagina' => 'principal',
                "proyectos" => count($proyectos["proyectos"])
            ]);
    }

    public function contacto(){
        $proyectos = $this->obtenerProyectos(0);
        return view('principal.contacto')->with([
            'pagina' => 'principal',
            "proyectos" => count($proyectos["proyectos"])
        ]);
    }
}
