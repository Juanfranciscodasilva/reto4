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
        Route::get("/crear", "ControllerPrincipal@abrirCrearProyecto")->name("crear");

        Route::get("/perfil", "ControllerPrincipal@perfil")->name("perfil");

        //RUTAS DE PROYECTO

        Route::get("/proyecto/{id}","ControllerProyecto@entrar")->name('proyecto');
        Route::get("eliminarProyecto/{id}", "ControllerProyecto@eliminar");
