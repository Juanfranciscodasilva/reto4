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
    //Raiz
        Route::get('/','ControllerLogin@index')->name('login.home');
    //Iniciar sesión
        Route::post('/',"ControllerLogin@iniciarSesion")->name("iniciarSesion");
    //Registro
        //Vista
            Route::get('/registro',function (){
               return view('login.registro')->with('seleccionado',1);
            })->name('registro.index');
        //Añadir usuario
            Route::post('/registro','ControllerLogin@registrar')->name('registrar.registro');
    //Restablecer contraseña
    //Principal
        Route::get('/principal',"ControllerPrincipal@entrar")->name("principal");
        Route::get("/proyectos", "ControllerPrincipal@proyectos")->name("proyectos");
        Route::get("/crear", "ControllerPrincipal@abrirCrearProyecto")->name("crear");

        Route::get("/perfil", "ControllerPrincipal@perfil")->name("perfil");

        //RUTAS DE PROYECTO

        Route::get("/proyecto/{id}","ControllerProyecto@establecerID");
        Route::get("/informacion" , "ControllerProyecto@entrar")->name("proyecto");
        Route::get("/archivos" , "ControllerProyecto@archivos")->name("archivos");
        Route::get("/chat" , "ControllerProyecto@chat")->name("chat");
        Route::get("/tareasActivas" , "ControllerProyecto@tareasActivas")->name("tareasActivas");
        Route::get("/tareasFinalizadas" , "ControllerProyecto@tareasFinalizadas")->name("tareasFinalizadas");
        Route::get("/integrantes" , "ControllerProyecto@integrantes")->name("integrantes");
        Route::get("/crearTarea" , "ControllerProyecto@crearTarea")->name("crearTarea");
        Route::post("/crearTarea" , "ControllerProyecto@insertarTarea")->name("crearTarea");
        Route::post("/finalizarTarea" , "ControllerProyecto@finalizarTarea")->name("finalizarTarea");
        Route::get("eliminarProyecto/{id}", "ControllerProyecto@eliminar");
        Route::post("crearProyecto", "ControllerProyecto@crear")->name("crearProyecto");
        Route::post("crearComentario","ControllerProyecto@crearComentario")->name("crearComentario");

        Route::post("/addColaborador","ControllerProyecto@addColaborador")->name("addColaborador");
