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
            'registrado' => "",
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
                    'registrado' => "",
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
                'registrado' => "",
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
            'registrado' => "Cuenta creada correctamente",
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

    //Metodo para comprobar si el email existe o no
    public function email(){
        $email = \request('email');
        $busqueda = Usuario::get()->where('email',$email);

        if (count($busqueda) == 0)
        {
            return view('login.restablecer.email')->with([
                'seleccionado' => 2,
                'error' => 'El correo electronico es incorrecto'
            ]);
        }

        Session::put('email',$email);
        $this->correocodigo($email);
        return view('login.restablecer.codigo')->with('seleccionado',2);
    }

    //Metodo para enviar el correo con el codigo de verificación
    public function correocodigo($email){
        $numero = "";

        for ($n = 0;$n < 5; $n++){
            $numero .= rand(0,9);
        }

        $numeroale = ['numero' => $numero];
        Session::put('codigo',$numeroale);
        $subject = "PlanTool Restablecer contraseña";
        $for = $email;

        Mail::send('emails.codigo',$numeroale,function ($msj) use ($subject,$for){
            $msj->from('developersweapp@gmail.com','PlanTool');
            $msj->subject($subject);
            $msj->to($for);
        });
    }

    //Metodo para comprobar el codigo de verificación
    public function codigo(){
        $codigo = \request('codigo');

        if ($codigo != Session::get('codigo')['numero'])
        {
            return view('login.restablecer.codigo')->with([
                'seleccionado' => 2,
                'error' => 'Código de verificación incorrecto'
            ]);
        }

        Session::remove('codigo');
        return view('login.restablecer.contra')->with('seleccionado',2);
    }

    //Metodo para reenviar el codigo de verificación
    public function reenviar(){
        $subject = "PlanTool Restablecer contraseña";
        $for = Session::get('email');

        Mail::send('emails.codigo',Session::get('codigo'),function ($msj) use ($subject,$for){
            $msj->from('developersweapp@gmail.com','PlanTool');
            $msj->subject($subject);
            $msj->to($for);
        });

        return view('login.restablecer.codigo')->with('seleccionado',2);
    }

    //Metodo para modificar la contraseña al usuario
    public function modificarcontra(){
        $contra = \request('pass');

        $datosusu = Usuario::get()->where('email',Session::get('email'));
        $usuario = Usuario::find($datosusu[0]->id);
        $usuario->password = Hash::make($contra);
        $usuario->save();

        $this->correomodif();
        return view('login.index')->with([
            'registrado' => "Contraseña modificada correctamente",
            'usuario' => Session::get('email'),
            'password' => $contra,
            'seleccionado' => 0
        ]);
    }

    //Metodo para mandar el correo cuando se modifica la contraseña
    public function correomodif(){
        $subject = "PlanTool Contraseña Modificada";
        $for = Session::get('email');

        $links = [
            'link' => 'https://reto4.herokuapp.com/contacto'
        ];

        Mail::send('emails.confir',$links,function ($msj) use ($subject,$for){
            $msj->from('developersweapp@gmail.com','PlanTool');
            $msj->subject($subject);
            $msj->to($for);
        });
    }
}
