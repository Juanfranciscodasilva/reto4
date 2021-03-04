<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidacionPerfil;
use App\Models\Integrante;
use App\Models\Proyecto;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ControllerPerfil extends Controller
{
    //Metodo para mostrar la pagina principal del pefil
        public function perfil(){
            if (Session::exists("usuario")) {
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
                    ]);
            }
            return redirect('/');
        }

    //Metodo para mostrar la vista de modificar contraseña
        public function modcontra(){
            if (Session::exists('usuario')){
                return view('perfil.modificarcontra')->with(
                    [
                        'pagina' =>'perfil',
                        'usuarioreal' => ''
                    ]
                );
            }
            return redirect('/');
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

            echo "<script>
                    alert('Contraseña modificada correctamente');
                    location.href = '/perfil';
                  </script>";
        }

    //Metodo para mandar el correo
        public function correo(){
            $subject = "PlanTool Contraseña Modificada";
            $for = Session::get('usuario')->email;

            $links = [
                'link' => 'https://reto4.herokuapp.com/contacto'
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
            $imagen->move('/img/perfil/',$nombrehash);
            $usuario = Usuario::find(Session::get('usuario')->id);
            $usuario->imagen = $nombrehash;
            $usuario->save();
            Session::get('usuario')->imagen = $nombrehash;
            return redirect()->route('perfil');
        }

    //Metodo para mostrar la vista para modificar los datos del usuario
        public function modperfil(){
            if (Session::exists('usuario')){
                return view('perfil.modificarperfil')->with(
                    [
                        'pagina' =>'perfil',
                        'usuarioreal' => '',
                        'perfil' => true
                    ]
                );
            }
            return redirect('/');
        }

    //Metodo para modificar los datos del usuario
        public function modificarperfil(ValidacionPerfil $request){
            $usuario = Usuario::find(Session::get('usuario')->id);

            $usuario->nombre = $request->nombre;
            $usuario->apellidos = $request->apellidos;
            $usuario->usuario = $request->usuario;
            $usuario->email = $request->email;

            $usuario->save();

            Session::get('usuario')->nombre = $request->nombre;
            Session::get('usuario')->apellidos = $request->apellidos;
            Session::get('usuario')->usuario = $request->usuario;
            Session::get('usuario')->email = $request->email;

            echo "<script>alert('Los datos se han modificado correctamente');location.href = '/perfil';</script>";
        }

    //Metodo para comprobar si el perfil al que queremos acceder es del usuario en sesion o no
        public function perfilusu($id){
            if (Session::exists("usuario")) {
                if ($id == Session::get('usuario')->id){
                    return redirect()->route('perfil');
                }

                $usuario = Usuario::get()->where('id',$id)->first();
                Session::put('usuarioperfil',$usuario);

                $proyectosd = Integrante::get()->where('usuario',$id)->toArray();
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
                        'usuarioreal' => Session::get('usuarioperfil')->nombre,
                        "passCambiada" => false
                    ]);
            }
            return redirect('/');
        }

    //Metodo para eliminar el usuario
        public function eliminarusuario(){
            if (Session::exists('usuario')){
                if (Session::get('usuario')->imagen != 'foto1.png'){
                    if (Session::get('usuario')->imagen != 'foto2.png'){
                        if (Session::get('usuario')->imagen != 'foto3.png'){
                            $file_path = public_path("/img/perfil/".Session::get('usuario')->imagen);
                            File::delete($file_path);
                        }
                    }
                }

                $usuario = Usuario::find(Session::get('usuario')->id);
                $usuario->delete();
                return "El usuario se ha eliminado correctamente";
            }
        }
}
