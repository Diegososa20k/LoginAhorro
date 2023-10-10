<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AhorroController;
use App\Http\Controllers\GraficaController;
use App\Http\Controllers\InversionController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::middleware('auth:sanctum')->group(function () {
//     Route::apiResource('ahorros', AhorroController::class);
//     Route::post('ahorros/actualizar-resultado-acumulado', [AhorroController::class, 'actualizarResultadoAcumulado']);
//     Route::post('ahorros/actualizar-resultado-acumulado/{id}', [AhorroController::class, 'actualizarResultadoAcumuladoUno']);
// });

//Ruta para la tabla ahorro
Route::middleware('auth:sanctum')->post('/user/ahorros', [AhorroController::class, 'store']);
Route::middleware('auth:sanctum')->get('/user/ahorros', [AhorroController::class, 'index']);
Route::middleware('auth:sanctum')->delete('/user/ahorros/{id}', [AhorroController::class, 'destroy']);
Route::middleware('auth:sanctum')->put('/user/ahorros/{id}', [AhorroController::class, 'update']);

Route::post('/user/ahorros/actualizar-resultado-acumulado', [AhorroController::class, 'actualizarResultadoAcumulado']);
Route::post('/user/ahorros/actualizar-resultado-acumulado/{id}', [AhorroController::class, 'actualizarResultadoAcumuladoUno']);

//Ruta para editar usuario
Route::middleware('auth:sanctum')->get('/user-data', [UserController::class, 'getUserData']);
Route::middleware('auth:sanctum')->put('/user-data', [UserController::class, 'updateUserData']);

//Para poner rutas de la ventana o vistas
Route::get('/grafica', [GraficaController::class, 'mostrarGrafica'])->name('grafica');
Route::get('/inversion', [InversionController::class, 'mostrarInversion'])->name('inversion');
Route::get('/editar-usuario', [UserController::class, 'editUser'])->name('editar-usuario');
