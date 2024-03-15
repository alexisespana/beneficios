<?php

use App\Http\Controllers\BeneficiosController;
use App\Http\Controllers\BeneficiosEntregadosController;
use App\Http\Controllers\FichaController;
use App\Http\Controllers\UsuariosController;
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

Route::get('misbeneficios/{RUT}', [BeneficiosController::class, 'index']);
Route::get('/', [UsuariosController::class, 'index'])->name('listar-usuarios');

Route::prefix('Usuarios')->group(function () {
    Route::get('/listar', [UsuariosController::class, 'index'])->name('listar-usuarios');
    Route::post('/crearUsuarios', [UsuariosController::class, 'crear_usuarios'])->name('crear-usuarios');
    Route::view('/agregar-usuario', 'Usuarios.FormAgUsuario');
    Route::get('/misbeneficios/{run}', [UsuariosController::class, 'misbeneficios'])->name('misbeneficios');
});
Route::prefix('Beneficios')->group(function () {
    Route::get('/listar', [BeneficiosController::class, 'beneficios'])->name('listar-beneficios');
    Route::get('/crear', [BeneficiosController::class, 'crear_beneficios'])->name('crear-beneficios');
    Route::get('/editar/{id} ', [BeneficiosController::class, 'crear_beneficios'])->name('editar-beneficios');
    Route::post('/guardar', [BeneficiosController::class, 'guardar_beneficios'])->name('guardar-beneficios');
});
Route::prefix('Ficha')->group(function () {
    Route::get('/listar', [FichaController::class, 'ficha'])->name('listar-fichas');
    Route::get('/crear', [FichaController::class, 'crear_ficha'])->name('crear-fichas');
    Route::get('/editar/{id} ', [FichaController::class, 'crear_ficha'])->name('editar-fichas');
    Route::post('/guardar', [FichaController::class, 'guardar_ficha'])->name('guardar-ficha');
});
Route::prefix('Beneficios-entregados')->group(function () {

    Route::get('/listar/', [BeneficiosEntregadosController::class, 'listar'])->name('listar-beneficio');
    Route::get('/agregar/{id}', [BeneficiosEntregadosController::class, 'agregar'])->name('agregar-beneficio');
    Route::post('/asignar/', [BeneficiosEntregadosController::class, 'asignarBeneficios'])->name('asignar-beneficio');
});
