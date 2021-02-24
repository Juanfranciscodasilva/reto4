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
               return view('login.registro');
            })->name('registro.index');
        //Añadir usuario
            Route::post('/registro','ControllerLogin@registrar')->name('registrar.registro');
    //Restablecer contraseña
    //Principal
        Route::get('/principal',"ControllerPrincipal@entrar")->name("principal");

