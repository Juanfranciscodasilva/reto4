<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use App\Models\ArchivoComentario;
use App\Models\ArchivoProyecto;
use App\Models\Comentario;
use App\Models\Integrante;
use App\Models\Proyecto;
use App\Models\Tarea;
use App\Models\Usuario;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ControllerProyecto extends Controller
{
    public function establecerID($id){
        Session::put("proyecto",$id);
        return redirect("/informacion");
    }

    public function entrar(){
        if (!$this->comprobarExistenciaDeProyectoEnSesion()){
            return redirect("/principal");
        }
        //ver si el usuario es coordinador
        $permiso = $this->obtenerPermiso();

        //obtener los datos del proyecto
        $proyecto = Proyecto::find(Session::get("proyecto"));

        //obtener la fecha de entrada del usuario al proyecto
        if ($permiso == 2){
            $fecha_entrada = $proyecto;
        }
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
            "estado" => $proyecto->estado,
            "fecha_entrada" => $fecha_entrada->created_at,
            "coordinador" => $coordinador,
            "integrantes" => $integrantes
        ]);
    }

    public function archivos(){
        if (!$this->comprobarExistenciaDeProyectoEnSesion()){
            return redirect("/principal");
        }
        $permiso = $this->obtenerPermiso();
        $archivos = $this->obtenerArchivosProyecto();
        $proyecto = Proyecto::find(Session::get("proyecto"));
        return view("proyecto.archivos")->with([
            "pagina" => "proyecto",
            "permiso" => $permiso,
            "archivos" => $archivos,
            "estado" => $proyecto->estado
        ]);
    }

    public function obtenerArchivosProyecto(){
        $proyecto = Session::get("proyecto");
        $archivos = ArchivoProyecto::where("proyecto",$proyecto)->paginate(5);
        foreach ($archivos as $archivo){
            $extension = substr(strrchr($archivo->archivo_original, "."), 1);
            $archivo->extension = strtolower($extension);
        }
        return $archivos;
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
            foreach ($archivos as $archivo){
                $extension = substr(strrchr($archivo->archivo_original, "."), 1);
                $archivo->extension = strtolower($extension);
            }
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
        $proyecto = Proyecto::find(Session::get("proyecto"));
        $integrantes = Integrante::get()->where("proyecto",$proyecto->id);
        $integrantes = $this->obtenerInformacionIntegrantes($integrantes);
        $usuarios = $this->obtenerUsuariosNoPertenecientes($proyecto->id);
        return view("proyecto.integrantes")->with([
            "pagina" => "proyecto",
            "permiso" => $permiso,
            "estado" => $proyecto->estado,
            "integrantes" => $integrantes,
            "usuariosNoPertenecientes" => $usuarios
        ]);
    }

    public function obtenerInformacionIntegrantes($integrantes){
        $info = [];
        foreach ($integrantes as $integrante){
            $usuario = Usuario::find($integrante->usuario);
            if ($integrante->permiso){
                $usuario->rol = "Coordinador";
                array_unshift($info,$usuario);
            }else{
                $usuario->rol = "Colaborador";
                array_push($info,$usuario);
            }
        }
        return $info;
    }

    public function obtenerUsuariosNoPertenecientes($proyecto){
        $usuarios = Usuario::get();
        $usuariosNoPertenecientes = [];
        foreach ($usuarios as $usuario){
            $integrante = Integrante::get()->where("usuario",$usuario->id)->where("proyecto",$proyecto)->first();
            if ($integrante == null){
                array_push($usuariosNoPertenecientes,$usuario);
            }
        }
        return $usuariosNoPertenecientes;
    }

    public function eliminar($id){
        $usuario = Session::get("usuario");
        $integrante = Integrante::get()->where("usuario",$usuario->id)->where("proyecto",$id)->first();
        $proyecto = Proyecto::find($id);
        if ($integrante->permiso){
            $proyecto->delete();
        }else{
            Integrante::where("usuario",$usuario->id)->where("proyecto",$id)->delete();
        }
        return redirect("/principal");
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

    public function obtenerPermiso(){
        $usuario = Session::get("usuario");
        $proyecto = Session::get("proyecto");
        $proyecto = Proyecto::find($proyecto);
        $permiso = Integrante::get()->where("usuario",$usuario->id)->where("proyecto",$proyecto->id)->first();
        if ($permiso == null)
            return 2;
        else
            return $permiso->permiso;
    }

    public function crearTarea(){
        if (!$this->comprobarExistenciaDeProyectoEnSesion()){
            return redirect("/principal");
        }
        $permiso = $this->obtenerPermiso();
        $integrantes = $this->obtenerIntegrantes(Session::get("proyecto"));
        $proyecto = Proyecto::find(Session::get("proyecto"));
        return view("proyecto.crearTarea")->with([
            "pagina" => "proyecto",
            "permiso" => $permiso,
            "integrantes" => $integrantes,
            "estado" => $proyecto->estado
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

            $archivoInsertado = ArchivoComentario::create([
                "archivo_original" => \request($nombre),
                "archivo_hash" => "",
                "autor" => $autor->id,
                "comentario" => $comentario->id
            ]);

            $file = \request("archivo".$x);
            $extension = $file->extension();
            $nombreID = $archivoInsertado->id."_comentarios.".$extension;
            $file->move(public_path('archivos'),$nombreID);
            $archivoInsertado->archivo_hash = $nombreID;
            $archivoInsertado->save();
        }
        return back();
    }

    public function subirArchivos()
    {
        $proyecto = Session::get("proyecto");
        $autor = Session::get("usuario");
        $condicion = true;
        for ($x = 0; $condicion; $x++) {
            $nombre = "nombreArchivo" . $x;
            if (!request()->has($nombre)) {
                $condicion = false;
                break;
            }

            $archivoInsertado = ArchivoProyecto::create([
                "archivo_original" => \request($nombre),
                "archivo_hash" => "",
                "autor" => $autor->id,
                "proyecto" => $proyecto
            ]);

            $file = \request("archivo".$x);
            $extension = $file->extension();
            $nombreID = $archivoInsertado->id."_proyecto.".$extension;
            $file->move(public_path('archivos'),$nombreID);
            $archivoInsertado->archivo_hash = $nombreID;
            $archivoInsertado->save();
        }
        return back();
    }

    public function descargar($hash,$nombre){
        return response()->download("archivos/".$hash,$nombre);
    }

    public function eliminarArchivo($id,$hash){
        $archivo = ArchivoProyecto::find($id);
        $archivo->delete();
        unlink("archivos/".$hash);
        return back();
    }

    public function invitarIntegrante($id){
        $usuario = Usuario::find($id);
        $proyecto = Proyecto::find(Session::get("proyecto"));
        $coordinador = Integrante::get()->where("proyecto",Session::get("proyecto"))->where("permiso",true)->first();
        $coordinador = Usuario::find($coordinador->usuario);
        $datos = [
            "usuario" => $usuario,
            "coordinador" => $coordinador,
            "proyecto" => $proyecto,
            "ruta" => \request()->root()
        ];
        $subject = "PlanTool Invitación a colaborar";
        $for = $usuario->email;

        Mail::send('emails.invitacion', $datos, function ($msj) use ($subject,$for){
            $msj->from('developersweapp@gmail.com','PlanTool');
            $msj->subject($subject);
            $msj->to($for);
        });
        return back();
    }

    public function addIntegrante($usuario,$proyecto){
        $usuario = base64_decode($usuario);
        $proyecto = base64_decode($proyecto);
        $usuario2 = Usuario::find($usuario);
        $proyecto2 = Proyecto::find($proyecto);
        if ($usuario2 == null || $proyecto2 == null){
            return redirect("/");
        }
        Integrante::create([
           "usuario" => $usuario,
           "proyecto" => $proyecto,
            "permiso" => false
        ]);
        return redirect("/");
    }

    public function expulsarIntegrante($id){
        $proyecto = Session::get("proyecto");
        Integrante::where("proyecto",$proyecto)->where("usuario",$id)->delete();
        return back();
    }

    public function eliminarmensaje($id){
        $comentario = Comentario::find($id);
        $listarchivos = ArchivoComentario::get()->where('comentario',$id);

        foreach ($listarchivos as $archivos)
        {
            $file_path = public_path("/archivos/".$archivos->archivo_hash);
            File::delete($file_path);
        }

        $comentario->delete();
        return redirect()->back();
    }

    public function solicitarunirse(){
        $coordinador = Integrante::get()->where('proyecto',Session::get('proyecto'))->where('permiso',true)->first();
        $proyecto = Proyecto::find($coordinador->proyecto);
        $usuario = Usuario::find($coordinador->usuario);

        $datos = [
            'usuario' => Session::get('usuario'),
            'proyecto' => $proyecto
        ];

        $subject = 'PlanTool';
        $for = $usuario->email;

        Mail::send('emails.union',$datos,function ($msj) use ($subject,$for){
            $msj->from('developersweapp@gmail.com','PlanTool');
            $msj->subject($subject);
            $msj->to($for);
        });

        echo "<script>alert('La solicitud de unión se ha enviado correctamente. Espera hasta que el coordinador decida si añadirte o no al proyecto');location.href='/principal';</script>";
    }
}
