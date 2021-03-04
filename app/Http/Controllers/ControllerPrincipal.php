<?php

namespace App\Http\Controllers;

use App\Models\Integrante;
use App\Models\Proyecto;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\In;

class ControllerPrincipal extends Controller
{
    public function entrar(){
        if (Session::exists("usuario")){
            $proyectos = $this->obtenerProyectos(6);
            foreach ($proyectos["proyectos"] as $proyecto)
            {
                $integrante = Integrante::get()->where('usuario',Session::get('usuario')->id)->where('proyecto',$proyecto->id)->first();
                $proyecto->favorito = $integrante->favorito;
            }

            $listafavoritos = Integrante::get()->where('usuario',Session::get('usuario')->id)->where('favorito',true);

            return view("principal.principal")->with([
                "pagina" => "principal",
                "proyectos" => count($proyectos["proyectos"]),
                "listaproyectos" => $proyectos,
                'listafavoritos' => count($listafavoritos),
            ]);
        }
        return redirect("/");
    }

    public function proyectos(){
        if (Session::exists("usuario")) {
            $proyectos = $this->obtenerProyectos(6);
            $listafavoritos = Integrante::get()->where('usuario', Session::get('usuario')->id)->where('favorito', true);
            return view("principal.proyectos")->with([
                "pagina" => "principal",
                "proyectos" => count($proyectos["proyectos"]),
                "listaproyectos" => $proyectos,
                'listafavoritos' => count($listafavoritos),
            ]);
        }
        return redirect("/");
    }

    public function abrirCrearProyecto(){
        if (Session::exists("usuario")) {
            $proyectos = $this->obtenerProyectos(0);
            $listafavoritos = Integrante::get()->where('usuario',Session::get('usuario')->id)->where('favorito',true);
            return view("principal.crearProyecto")->with([
                "pagina" =>"principal",
                "proyectos" => count($proyectos["proyectos"]),
                'listafavoritos' => count($listafavoritos),
            ]);
        }
        return redirect('/');
    }

    public function perfil(){
        if (Session::exists("usuario")) {
            return view("perfil.perfil")->with("pagina","perfil");
        }
        return redirect('/');
    }

    public function obtenerProyectos($paginacion){
        $proyectos = [];
        $usuario = Session::get("usuario")->id;

        if ($paginacion == 0){
            $ids = Integrante::get()->where("usuario",$usuario)->orderBy('created_at','DESC');
        }else{
            $ids = Integrante::where("usuario",$usuario)->orderBy('created_at','DESC')->paginate($paginacion);
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
            "ids" => $ids,
        ];

        return $datosProyectos;
    }

    public function vistaest(){
        if (Session::exists("usuario")) {
            $proyectos = $this->obtenerProyectos(0);
            $listafavoritos = Integrante::get()->where('usuario',Session::get('usuario')->id)->where('favorito',true);

            return view('principal.estadisticas')->with(
                [
                    'pagina' => 'principal',
                    "proyectos" => count($proyectos["proyectos"]),
                    'listafavoritos' => count($listafavoritos),
                ]);
        }
        return redirect('/');
    }

    public function contacto(){
        if (Session::exists("usuario")) {
            $proyectos = $this->obtenerProyectos(0);
            $listafavoritos = Integrante::get()->where('usuario',Session::get('usuario')->id)->where('favorito',true);

            return view('principal.contacto')->with([
                'pagina' => 'principal',
                "proyectos" => count($proyectos["proyectos"]),
                'listafavoritos' => count($listafavoritos),
            ]);
        }
        return redirect('/');
    }

    public function anadirfavorito($id){
        if (Session::exists("usuario")) {
            DB::update('update integrantes set favorito = ? where usuario = ? and proyecto = ?',[true,Session::get('usuario')->id,$id]);

            return redirect()->route('principal');
        }
        return redirect('/');
    }

    public function eliminarfavorito($id){
        if (Session::exists("usuario")) {
            DB::update('update integrantes set favorito = ? where usuario = ? and proyecto = ?',[false,Session::get('usuario')->id,$id]);
            return redirect()->route('principal');
        }
        return redirect('/');
    }

    public function listafavoritos(){
        if (Session::exists("usuario")) {
            $listafavoritos = Integrante::get()->where('usuario',Session::get('usuario')->id)->where('favorito',true);

            $listaproyectos = [];
            $proyectos = $this->obtenerProyectos(0);

            foreach ($listafavoritos as $favoritos){
                $proyecto = Proyecto::find($favoritos->proyecto);
                $integrantes = Integrante::get()->where('proyecto',$proyecto->id)->where('favorito',true);
                $proyecto->contadorfav = count($integrantes);

                array_push($listaproyectos,$proyecto);
            }

            if (count($listaproyectos) == 0)
                return redirect()->route('principal');

            return view('principal.listafavoritos')->with(
                ['pagina' => 'principal',
                    'listafavoritos' => count($listafavoritos),
                    'listaproyectos' => $listaproyectos,
                    'proyectos' => count($proyectos),
                ]
            );
        }
        return redirect('/');
    }

    public function eliminarfav($id){
        if (Session::exists("usuario")) {
            DB::update('update integrantes set favorito = ? where usuario = ? and proyecto = ?',[false,Session::get('usuario')->id,$id]);
            return redirect()->back();
        }
        return redirect('/');
    }
}
