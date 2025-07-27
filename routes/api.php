<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PrestadorController;
use App\Http\Controllers\ZonaController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\LocalidadController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CtaCteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/prestador',[PrestadorController::class,'list_prestadores']);
Route::post('/prestador/search/{search}',[PrestadorController::class,'search_prestador']);
Route::post('/prestador/search/one/{search}',[PrestadorController::class,'search_one_prestador']);
Route::get('/prestador/searchos/{search}',[PrestadorController::class,'search_prestador_by_os']);
Route::post('/prestador/searchaf/{search}',[PrestadorController::class,'search_prestador_with_afiliados']);

Route::get('/prestador/exportall/',[PrestadorController::class,'export_all_prestador']);
Route::get('/prestador/export/{search}',[PrestadorController::class,'export_prestador_by_param']);

Route::get('/cuenta/{req}',[CtaCteController::class,'list_ctacte_prestador']);
Route::get('/cuenta/search/{req}/{periodo}',[CtaCteController::class,'search_ctacte_prestador']);
Route::get('/cuenta/export/{req}',[CtaCteController::class,'export_ctacte_prestador']);

Route::get('/zona',[ZonaController::class,'list_zonas']);
Route::post('/zona/search/{search}',[ZonaController::class,'search_zona']);

Route::get('/especialidad',[EspecialidadController::class,'list_especialidades']);
Route::post('/especialidad/search/{search}',[EspecialidadController::class,'search_especialidad']);

Route::get('/localidad',[LocalidadController::class,'list_localidades']);
Route::post('/localidad/search/{search}',[LocalidadController::class,'search_localidad']);

Route::get('/user',[UsuarioController::class,'list_users']);
Route::post('/user/search/{search}',[UsuarioController::class,'search_user']);

Route::post('/login',[UsuarioController::class,'login']);