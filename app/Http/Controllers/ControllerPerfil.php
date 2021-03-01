<?php

namespace App\Http\Controllers;

use App\Models\Integrante;
use App\Models\Proyecto;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ControllerPerfil extends Controller
{
    //Metodo para mostrar la pagina principal del pefil
    public function perfil( $passCambiada = false){
        $proyectosd = Integrante::get()->where('usuario',Session::get('usuario')->id)->toArray();

        $proyectos = array_values($proyectosd);

        $listaproyectos = [];

        for ($n = 0;$n < count($proyectos); $n++)
        {
            $proyec = Proyecto::get()->where('id',$proyectos[$n]["proyecto"])->sortBy('created_at')->first();
            $listaproyectos[] = $proyec;
        }

        return view("perfil.perfil")->with(
            [
                "pagina" => "perfil",
                "listaproyectos" => $listaproyectos,
                'usuarioreal' => '',
                "passCambiada" => $passCambiada
            ]);
    }

    //Metodo para mostrar la vista de modificar contraseña
    public function modcontra(){
        return view('perfil.modificarcontra')->with(
            [
                'pagina' =>'perfil',
                'usuarioreal' => ''
            ]
        );
    }

    //Metodo para comprobar y modificar la contraseña
    public function comprobaractucontra(){
        $contraactu = \request('contract');

        if (!Hash::check($contraactu,Session::get('usuario')->password))
        {
            return view('perfil.modificarcontra')->with(
                [
                    'error' => 'Contraseña actual incorrecta',
                    'pagina' => 'perfil',
                    'usuarioreal' => ''
                ]
            );
        }

        $password = Hash::make(\request('pass'));

        $usuario = Usuario::find(Session::get('usuario')->id);
        $usuario->password = $password;
        $usuario->save();
        Session::get('usuario')->password = $password;
        $this->correo();
        return $this->perfil(true);
    }

    //Metodo para mandar el correo
    public function correo(){
        $subject = "PlanTool Contraseña Modificada";
        $for = Session::get('usuario')->email;

        $links = [
            'link' => 'https://plantool.herokuapp.com/contacto'
        ];

        Mail::send('emails.confir',$links,function ($msj) use ($subject,$for){
            $msj->from('developersweapp@gmail.com','PlanTool');
            $msj->subject($subject);
            $msj->to($for);
        });
    }

    //Metodo para modificar la imagen
    public function modificarimagen(Request $request){
        $imagen = $request->file('foto');
        $nombrehash = $request->file('foto')->hashName();
        $imagen->move('img/perfil/',$nombrehash);
        $usuario = Usuario::find(Session::get('usuario')->id);
        $usuario->imagen = $nombrehash;
        $usuario->save();
        Session::get('usuario')->imagen = $nombrehash;
        return redirect()->route('perfil');
    }

    //Metodo para mostrar la vista para modificar los datos del usuario
    public function modperfil(){
        return view('perfil.modificarperfil')->with(
            [
                'pagina' =>'perfil',
                'usuarioreal' => ''
            ]
        );
    }
}
