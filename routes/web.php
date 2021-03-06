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
        //Favorito
            Route::get("/anadirfavorito/{id}" , "ControllerPrincipal@anadirfavorito")->name("añadirfavorito");
            Route::get("/quitarfavorito/{id}" , "ControllerPrincipal@eliminarfavorito")->name("eliminarfavorito");
        //Lista de favoritos
            Route::get('/listafavoritos','ControllerPrincipal@listafavoritos')->name('listafavoritos');
            Route::get('/eliminarlistfav/{id}','ControllerPrincipal@eliminarfav')->name('eliminarfav');
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
                Route::patch('/modificarperfil','ControllerPerfil@modificarperfil')->name('modificarperfil');
        //Eliminar usuarios
            Route::get('/eliminarusuario','ControllerPerfil@eliminarusuario')->name('eliminarusuario');

    //Proyecto
        //Información de cada proyecto
            Route::get("/proyecto/{id}","ControllerProyecto@establecerID");
            Route::get("/informacion" , "ControllerProyecto@entrar")->name("proyecto");
        //Chat
            Route::get("/chat" , "ControllerProyecto@chat")->name("chat");
            Route::get('/chat/{mensaje}','ControllerProyecto@eliminarmensaje')->name('eliminarmensaje');
        //Solicitar unirse
            Route::get('/solicitarunirse','ControllerProyecto@solicitarunirse')->name('solicitarunirse');
        //Modificar proyecto
            Route::get('/modificarproyecto','ControllerProyecto@modificarproyecto')->name('modificarproyecto');
            Route::patch('/modificarproyecto','ControllerProyecto@modpro')->name('modpro');
        //Archivos de proyecto
            Route::get("/archivosProyecto" , "ControllerProyecto@archivos")->name("archivos");
        //Tareas
            Route::get("/tareasActivas" , "ControllerProyecto@tareasActivas")->name("tareasActivas");
            Route::get("/tareasFinalizadas" , "ControllerProyecto@tareasFinalizadas")->name("tareasFinalizadas");
        //Integrantes
            Route::get("/integrantes" , "ControllerProyecto@integrantes")->name("integrantes");
        //Crear tarea
            //Vista
                Route::get("/crearTarea" , "ControllerProyecto@crearTarea")->name("crearTarea");
            //Crear
                Route::post("/crearTarea" , "ControllerProyecto@insertarTarea")->name("crearTarea");
        //Finalizar tarea
            Route::post("/finalizarTarea" , "ControllerProyecto@finalizarTarea")->name("finalizarTarea");
        //Eliminar proyecto
            Route::get("/eliminarProyecto/{id}", "ControllerProyecto@eliminar");
        //Crear proyecto
            Route::post("/crearProyecto", "ControllerProyecto@crear")->name("crearProyecto");
        //Crear comentario
            Route::post("/crearComentario","ControllerProyecto@crearComentario")->name("crearComentario");
        //Subir archivos
            Route::post("/subirArchivos", "ControllerProyecto@subirArchivos")->name("subirArchivos");
        //Añadir colaborador
            Route::post("/addColaborador","ControllerProyecto@addColaborador")->name("addColaborador");
        //Descargar archivos
            Route::get('/descargar/{hash}/{nombre}',"ControllerProyecto@descargar")->name("descargar");
        //Eliminar archivos
            Route::get('/eliminarArchivo/{id}/{hash}',"ControllerProyecto@eliminarArchivo")->name("eliminarArchivo");
        //Invitar integrante
            Route::get('/invitarIntegrante/{id}',"ControllerProyecto@invitarIntegrante")->name("invitarIntegrante");
        //Añadir integrante
            Route::get('/addIntegrante/{usuario}/{proyecto}',"ControllerProyecto@addIntegrante")->name("addIntegrante");
        //Expulsar integrante
            Route::get('/expulsarIntegrante/{id}',"ControllerProyecto@expulsarIntegrante")->name("expulsarIntegrante");
