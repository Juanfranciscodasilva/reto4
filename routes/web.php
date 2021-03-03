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
        //Vista
        Route::get('/principal',"ControllerPrincipal@entrar")->name("principal");
        Route::get("/proyectos", "ControllerPrincipal@proyectos")->name("proyectos");
        //Crear proyecto
            Route::get("/crear", "ControllerPrincipal@abrirCrearProyecto")->name("crear");
            Route::get("/perfil", "ControllerPrincipal@perfil")->name("perfil");
        //Estadísticas
            Route::get('/estadisticas','ControllerPrincipal@vistaest')->name('estadisticas.index');
            Route::get('/estadisticas/{opcion}','ControllerEstadisticas@gestionarestadistica')->name('estadistica');
        //Contactar
            Route::get('/contacto','ControllerPrincipal@contacto')->name('contacto.index');
            Route::post('/contacto','ControllerPrincipal@contactar')->name('contactar');

    //Perfil
        //Vista Principal
            Route::get("/perfil", "ControllerPerfil@perfil")->name("perfil");
            Route::get('/perfilusu/{id}','ControllerPerfil@perfilusu')->name('perfilusu');
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

    //Proyecto

        //Vistas
   // Route::get("","");


        Route::get("/proyecto/{id}","ControllerProyecto@establecerID");
        Route::get("/informacion" , "ControllerProyecto@entrar")->name("proyecto");
        Route::get("/archivosProyecto" , "ControllerProyecto@archivos")->name("archivos");
        Route::get("/chat" , "ControllerProyecto@chat")->name("chat");
        Route::get("/tareasActivas" , "ControllerProyecto@tareasActivas")->name("tareasActivas");
        Route::get("/tareasFinalizadas" , "ControllerProyecto@tareasFinalizadas")->name("tareasFinalizadas");
        Route::get("/integrantes" , "ControllerProyecto@integrantes")->name("integrantes");
        Route::get("/crearTarea" , "ControllerProyecto@crearTarea")->name("crearTarea");
        Route::post("/crearTarea" , "ControllerProyecto@insertarTarea")->name("crearTarea");
        Route::post("/finalizarTarea" , "ControllerProyecto@finalizarTarea")->name("finalizarTarea");
        Route::get("/eliminarProyecto/{id}", "ControllerProyecto@eliminar");
        Route::post("/crearProyecto", "ControllerProyecto@crear")->name("crearProyecto");
        Route::post("/crearComentario","ControllerProyecto@crearComentario")->name("crearComentario");
        Route::post("/subirArchivos", "ControllerProyecto@subirArchivos")->name("subirArchivos");
        Route::post("/addColaborador","ControllerProyecto@addColaborador")->name("addColaborador");
        Route::get('/descargar/{hash}/{nombre}',"ControllerProyecto@descargar")->name("descargar");
        Route::get('/eliminarArchivo/{id}/{hash}',"ControllerProyecto@eliminarArchivo")->name("eliminarArchivo");
        Route::get('/invitarIntegrante/{id}',"ControllerProyecto@invitarIntegrante")->name("invitarIntegrante");
        Route::get('/addIntegrante/{usuario}/{proyecto}',"ControllerProyecto@addIntegrante")->name("addIntegrante");
        Route::get('/expulsarIntegrante/{id}',"ControllerProyecto@expulsarIntegrante")->name("expulsarIntegrante");
