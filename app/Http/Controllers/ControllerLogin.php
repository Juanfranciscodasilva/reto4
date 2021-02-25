<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidarRegistro;
use App\Models\Usuario;
use http\Env\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ControllerLogin extends Controller
{
    //Metodo para mostrar la vista del login
        public function index(){
            Session::remove("usuario");
            Session::remove("proyecto");
            return view('login.index')->with([
                'registrado' => false,
                'usuario' => "",
                'password' => "",
                'seleccionado' => 0
            ]);
        }

    //Metodo para iniciar sesion
        public function iniciarSesion(){
            $usuario = \request("usuario");
            $pass = \request("password");

            $busqueda = DB::select('select * from usuarios where usuario = ? or email = ?',[$usuario,$usuario]);

            if (count($busqueda)==0){
                //BUSCAR POR CORREO SI NO SE HA ENCONTRADO BUSCANDO POR USUARIO
                    if (count($busqueda)==0){
                        return view('login.index')->with([
                            'registrado' => false,
                            'usuario' => "",
                            'password' => "",
                            'error' => "Usuario o contraseña incorrecta",
                            'seleccionado' => 0
                        ]);
                    }
            }

            if (!Hash::check($pass,$busqueda[0]->password))
            {
                return view('login.index')->with([
                    'registrado' => false,
                    'usuario' => "",
                    'password' => "",
                    'error' => "Usuario o contraseña incorrecta",
                    'seleccionado' => 0
                ]);
            }

            //TODO GUARDAR USUARIO EN SESION
                Session::put('usuario',$busqueda[0]);
                return redirect("principal");
        }

    //Metodo para añadir y validar los datos que nos mandan por el formulario
        public function registrar(ValidarRegistro $request){
            $numero = rand(1,3);

            Usuario::create([
                'usuario' => $request->usuario,
                'password' => Hash::make($request->pass),
                'email' => $request->email,
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'imagen' => 'foto'.$numero.'.png'
            ]);

            $this->correo($request);
            return view('login.index')->with([
                'registrado' => true,
                'usuario' => $request->usuario,
                'password' => $request->pass,
                'seleccionado' => 0
            ]);
        }

    //Metodo para enviar el correo de confirmacion del registro
        public function correo($request){
            $subject = "PlanTool Registro";
            $for = $request->email;

            Mail::send('emails.registro', $request->all(), function ($msj) use ($subject,$for){
                  $msj->from('developersweapp@gmail.com','PlanTool');
                  $msj->subject($subject);
                  $msj->to($for);
                });
        }
}
