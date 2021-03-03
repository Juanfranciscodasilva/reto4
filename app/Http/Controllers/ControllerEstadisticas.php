<?php

namespace App\Http\Controllers;

use App\Models\Integrante;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ControllerEstadisticas extends Controller
{
    //Metodo para gestionar las estadisticas
        public function gestionarestadistica($opcion){
            switch ($opcion){
                case 'estado':
                    return $this->estado();
                break;
                case 'periodo':
                    return $this->periodo();
                break;
                default:
                    return $this->permiso();
            }
        }

    //En caso de que la opción sea estado sacaremos una estadistica donde saldrán los proyectos privados y publicos
        public function estado(){
            $usuario = Session::get("usuario")->id;
            $integrantes = Integrante::get()->where('usuario',$usuario);

            $countproyectos = 0;
            $privado = 0;
            $publico = 0;

            foreach($integrantes as $integrante){
                $proyecto = Proyecto::find($integrante->proyecto);
                $countproyectos++;
                if ($proyecto->estado)
                    $privado ++;
                else
                    $publico ++;
            }

            $privado = $privado * 100/$countproyectos;
            $publico = $publico * 100/$countproyectos;

            $datos = [
                'publico' => $publico,
                'privado' => $privado
            ];

            return $datos;
    }

    //En caso de que la opción sea periodo sacaremos todos los proyectos que ha creado el usuario por meses
        public function periodo(){
            $usuario = Session::get("usuario")->id;
            $integrantes = Integrante::get()->where('usuario',$usuario);

            $datos = [
                ["mes" => "Enero", "cantidad" => 0, "porcentaje" => 0],
                ["mes" => "Febrero", "cantidad" => 0, "porcentaje" => 0],
                ["mes" => "Marzo", "cantidad" => 0, "porcentaje" => 0],
                ["mes" => "Abril", "cantidad" => 0, "porcentaje" => 0],
                ["mes" => "Mayo", "cantidad" => 0, "porcentaje" => 0],
                ["mes" => "Junio", "cantidad" => 0, "porcentaje" => 0],
                ["mes" => "Julio", "cantidad" => 0, "porcentaje" => 0],
                ["mes" => "Agosto", "cantidad" => 0, "porcentaje" => 0],
                ["mes" => "Septiembre", "cantidad" => 0, "porcentaje" => 0],
                ["mes" => "Octubre", "cantidad" => 0, "porcentaje" => 0],
                ["mes" => "Noviembre", "cantidad" => 0, "porcentaje" => 0],
                ["mes" => "Diciembre", "cantidad" => 0, "porcentaje" => 0]
            ];

            foreach ($integrantes as $integrante) {
                switch (date("F", strtotime($integrante->created_at))) {
                    case "January":
                        $datos[0]["cantidad"]++;
                        break;
                    case "February":
                        $datos[1]["cantidad"]++;
                        break;
                    case "March":
                        $datos[2]["cantidad"]++;
                        break;
                    case "April":
                        $datos[3]["cantidad"]++;
                        break;
                    case "May":
                        $datos[4]["cantidad"]++;
                        break;
                    case "June":
                        $datos[5]["cantidad"]++;
                        break;
                    case "July":
                        $datos[6]["cantidad"]++;
                        break;
                    case "August":
                        $datos[7]["cantidad"]++;
                        break;
                    case "September":
                        $datos[8]["cantidad"]++;
                        break;
                    case "October":
                        $datos[9]["cantidad"]++;
                        break;
                    case "November":
                        $datos[10]["cantidad"]++;
                        break;
                    default:
                        $datos[11]["cantidad"]++;

                }
            }

            for ($x = 0; $x < count($datos); $x++) {
                $datos[$x]["porcentaje"] = $datos[$x]["cantidad"] * 100 / count($integrantes);
            }

            return $datos;
        }

    //En caso de que la opción sea permiso sacaremos todos los proyectos que ha creado el usuario por meses
        public function permiso(){
            $usuario = Session::get("usuario")->id;
            $integrantes = Integrante::get()->where('usuario',$usuario);

            $administrador = 0;
            $invitado = 0;

            foreach ($integrantes as $integrante){
                if ($integrante->permiso)
                    $administrador++;
                else
                    $invitado++;
            }

            $administrador = $administrador*100/count($integrantes);
            $invitado = $invitado*100/count($integrantes);

            $datos = [
                'administrador' => $administrador,
                'invitado' => $invitado,
            ];

            return $datos;
        }
}
