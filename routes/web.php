<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Login
    //Iniciar sesión
        //Vista
            Route::get('/','ControllerLogin@index')->name('login.home');
        //Inicio de sesion
            Route::post('/',"ControllerLogin@iniciarSesion")->name("iniciarSesion");

    //Registro
        //Vista
            Route::get('/registro',function (){
               return view('login.registro')->with('seleccionado',1);
            })->name('registro.index');
        //Añadir usuario
            Route::post('/registro','ControllerLogin@registrar')->name('registrar.registro');

    //Restablecer contraseña
        //Vista
            Route::get('/restablecer',function (){
                return view('login.restablecer.email')->with('seleccionado',2);
            })->name('restablecer.index');
        //Comprobar usuario
            Route::post('/restablecer','ControllerLogin@email')->name('restablecercontra.email');
        //Comprobar codigo
            Route::post('/codigo','ControllerLogin@codigo')->name('restablecercontra.codigo');
            Route::get('/reenviar','ControllerLogin@reenviar')->name('restablecercontra.reenviar');
        //Modificar contra
            Route::patch('/contra','ControllerLogin@modificarcontra')->name('restablecercontra.contra');

    //Principal
        Route::get('/principal',"ControllerPrincipal@entrar")->name("principal");
        Route::get("/proyectos", "ControllerPrincipal@proyectos")->name("proyectos");

    //Proyectos
        //Vista
            Route::get("/crear", "ControllerPrincipal@abrirCrearProyecto")->name("crear");
        //Crear proyecto
            Route::post("crearProyecto", "ControllerProyecto@crear")->name("crearProyecto");

    //Perfil
        //Vista Principal
            Route::get("/perfil", "ControllerPerfil@perfil")->name("perfil");
            //Modificar imagen
                Route::patch('/perfil','ControllerPerfil@modificarimagen')->name('modificarimagen');
        //Modificar contra
            //Vista
                Route::get('/modificarcontra','ControllerPerfil@modcontra')->name('modificarcontra.index');
            //Modificar
                Route::patch('/modificarcontra','ControllerPerfil@comprobaractucontra')->name('modificarcontra');
        //Modificar Perfil
            //Vista
                Route::get('/modificarperfil','ControllerPerfil@modperfil')->name('modificarperfil.index');
            //Modificar


        //RUTAS DE PROYECTO

        Route::get("/proyecto/{id}","ControllerProyecto@establecerID")->name('proyecto');
        Route::get("/chat" , "ControllerProyecto@chat")->name("chat");
        Route::get("eliminarProyecto/{id}", "ControllerProyecto@eliminar");
