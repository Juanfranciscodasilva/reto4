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

Route::get('/', "App\Http\Controllers\ControllerLogin@entrar");

//RUTAS DEL LOGIN

Route::post('/',"App\Http\Controllers\ControllerLogin@iniciarSesion")->name("iniciarSesion");

//RUTAS PAGINA PRINCIPAL

Route::get('/principal',"App\Http\Controllers\ControllerPrincipal@entrar")->name("principal");
Route::get("/proyectos", "App\Http\Controllers\ControllerPrincipal@proyectos")->name("proyectos");
Route::get("/crear", "App\Http\Controllers\ControllerPrincipal@abrirCrearProyecto")->name("crear");

//RUTAS PERFIL

Route::get("/perfil", "App\Http\Controllers\ControllerPrincipal@perfil")->name("perfil");
