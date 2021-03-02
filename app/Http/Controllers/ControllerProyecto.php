<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use App\Models\ArchivoComentario;
use App\Models\Comentario;
use App\Models\Integrante;
use App\Models\Proyecto;
use App\Models\Tarea;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ControllerProyecto extends Controller
{
    public function establecerID($id){
        Session::put("proyecto",$id);
        return redirect("/informacion");
    }

    public function entrar(){
        //ver si el usuario es coordinador
            $permiso = $this->obtenerPermiso();

        //obtener los datos del proyecto
            $proyecto = Proyecto::find(Session::get("proyecto"));

        //obtener la fecha de entrada del usuario al proyecto
            if ($permiso == 'nointegrante')
                $fecha_entrada = Integrante::get()->where("proyecto",$proyecto->id)->where("usuario",Session::get("usuarioperfil")->id)->first();
            else
                $fecha_entrada = Integrante::get()->where("proyecto",$proyecto->id)->where("usuario",Session::get("usuario")->id)->first();

        //obtener datos del coordinador del proyecto
            $coordinador = Integrante::get()->where("proyecto",$proyecto->id)->where("permiso",true)->first();
            $coordinador = Usuario::find($coordinador->usuario);

        //obtener numero de integrantes del proyecto
            $integrantes = count(Integrante::get()->where("proyecto",$proyecto->id));

        return view("proyecto.proyecto")->with([
            "pagina" => "proyecto",
            "permiso" => $permiso,
            "proyecto" => $proyecto,
            "fecha_entrada" => $fecha_entrada->created_at,
            "coordinador" => $coordinador,
            "integrantes" => $integrantes
        ]);
    }

    public function obtenerPermiso(){
        $usuario = Session::get("usuario");
        $proyecto = Session::get("proyecto");
        $proyecto = Proyecto::find($proyecto);
        $permiso = Integrante::get()->where("usuario",$usuario->id)->where("proyecto",$proyecto->id)->first();
        if ($permiso == null)
            return 'nointegrante';
        else
            return $permiso->permiso;
    }

    public function archivos(){
        if (!$this->comprobarExistenciaDeProyectoEnSesion()){
            return redirect("/principal");
        }
        $permiso = $this->obtenerPermiso();
        return view("proyecto.archivos")->with([
            "pagina" => "proyecto",
            "permiso" => $permiso
        ]);
    }

    public function chat(){
        if (!$this->comprobarExistenciaDeProyectoEnSesion()){
            return redirect("/principal");
        }
        $permiso = $this->obtenerPermiso();
        $idUsuario = Session::get("usuario")->id;
        $mensajes = $this->obtenerMensajes();
        return view("proyecto.chat")->with([
            "pagina" => "proyecto",
            "permiso" => $permiso,
            "idIniciado" => $idUsuario,
            "mensajes" => $mensajes
        ]);
    }

    public function obtenerMensajes(){
        $proyecto = Session::get("proyecto");
        $mensajes = Comentario::get()->where("proyecto",$proyecto);
        $mensajes = $this->obtenerInformacionAutorMensaje($mensajes);
        $mensajes = $this->obtenerArchivosMensajes($mensajes);
        return $mensajes;
    }

    public function obtenerInformacionAutorMensaje($mensajes){
        foreach ($mensajes as $mensaje){
            $autor = Usuario::find($mensaje->autor);
            $mensaje->autor = $autor;
        }
        return $mensajes;
    }

    public function obtenerArchivosMensajes($mensajes){
        foreach ($mensajes as $mensaje){
            $archivos = ArchivoComentario::get()->where("comentario",$mensaje->id);
            $mensaje->archivos = $archivos;
        }
        return $mensajes;
    }

    public function tareasActivas(){
        if (!$this->comprobarExistenciaDeProyectoEnSesion()){
            return redirect("/principal");
        }
        $permiso = $this->obtenerPermiso();
        $tareas = $this->obtenerTareas(false);
        $tareas2 = $this->convertirFechas($tareas);
        return view("proyecto.tareas")->with([
            "pagina" => "proyecto",
            "permiso" => $permiso,
            "paginacion" => $tareas,
            "tareas" => $tareas2,
            "estado" => "activas"
        ]);
    }

    public function tareasFinalizadas(){
        if (!$this->comprobarExistenciaDeProyectoEnSesion()){
            return redirect("/principal");
        }
        $permiso = $this->obtenerPermiso();
        $tareas = $this->obtenerTareas(true);
        $tareas2 = $this->convertirFechas($tareas);
        return view("proyecto.tareas")->with([
            "pagina" => "proyecto",
            "permiso" => $permiso,
            "paginacion" => $tareas,
            "tareas" => $tareas2,
            "estado" => "finalizadas"
        ]);
    }

    public function convertirFechas($tareas){
        foreach ($tareas as $tarea){
            $dateString = $tarea->vencimiento;
            $time = strtotime($dateString);
            $newDate = \date('d/m/Y',$time);
            $tarea->vencimiento = $newDate;
        }
        return $tareas;
    }

    public function integrantes(){
        if (!$this->comprobarExistenciaDeProyectoEnSesion()){
            return redirect("/principal");
        }

        $permiso = $this->obtenerPermiso();

        return view("proyecto.integrantes")->with([
            "pagina" => "proyecto",
            "permiso" => $permiso
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

        if (\request('estado') == 'publico')
            $estado = false;
        else
            $estado = true;

        Proyecto::create([
           "titulo" =>  \request("titulo"),
            "descripcion" => \request("descripcion"),
            "estado" => $estado
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

    public function crearTarea(){
        if (!$this->comprobarExistenciaDeProyectoEnSesion()){
            return redirect("/principal");
        }
        $permiso = $this->obtenerPermiso();
        $integrantes = $this->obtenerIntegrantes(Session::get("proyecto"));
        return view("proyecto.crearTarea")->with([
            "pagina" => "proyecto",
            "permiso" => $permiso,
            "integrantes" => $integrantes
        ]);
    }

    public function comprobarExistenciaDeProyectoEnSesion(){
        if (!Session::exists("proyecto")){
            return false;
        }
        return true;
    }

    public function insertarTarea(){
        $fecha = \date("Y-m-d",substr(\request("time"),0,-3));
        Tarea::create([
           "titulo" => \request("titulo"),
           "descripcion" => \request("descripcion"),
            "estado" => false,
            "vencimiento" => $fecha,
            "usuario" => \request("asignado"),
            "proyecto" => Session::get("proyecto")
        ]);
        return back();
    }

    public function obtenerIntegrantes($id){
        $ids = Integrante::get()->where("proyecto",$id);
        $integrantes= [];

        foreach ($ids as $integrante){
            $usuario = Usuario::find($integrante->usuario);
            array_push($integrantes,$usuario);
        }

        return $integrantes;
    }

    public function obtenerTareas($estado){
        $usuario = Session::get("usuario");
        $proyecto = Session::get("proyecto");
        $tareas = Tarea::orderBy("vencimiento")->where("usuario",$usuario->id)->where("proyecto",$proyecto)->where("estado",$estado)->paginate(6);
        return $tareas;
    }

    public function finalizarTarea(){
        $id = \request("tarea");
        $tarea = Tarea::find($id);
        $tarea->estado = true;
        $tarea->save();
        return back();
    }

    public function crearComentario(){
        $mensaje = \request("mensaje");
        $autor = Session::get("usuario");
        $proyecto = Session::get("proyecto");


         $comentario = Comentario::create([
            "comentario" => $mensaje,
            "autor" => $autor->id,
            "proyecto" => $proyecto
        ]);

        $condicion = true;
        for ($x=0;$condicion;$x++){
            $nombre = "nombreArchivo".$x;
            if (!request()->has($nombre)){
                $condicion = false;
                break;
            }
            $file = \request("archivo".$x);
            $extension = $file->extension();
            $hash = Hash::make(\request($nombre));
            $hashCompleto = $hash.".".$extension;
            $file->move(public_path('archivos'),$hashCompleto);

            ArchivoComentario::create([
                "archivo_original" => \request($nombre),
                "archivo_hash" => $hashCompleto,
                "autor" => $autor->id,
                "comentario" => $comentario->id
            ]);
        }
        return back();
    }

    public function addColaborador(){

        return back();
    }
}
