<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AhorroController;

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
Route::middleware('auth:sanctum')->post('/user/ahorros', [AhorroController::class, 'store']);
Route::middleware('auth:sanctum')->get('/user/ahorros', [AhorroController::class, 'getUserAhorros']);

