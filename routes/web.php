<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropietarioController;
use App\Http\Controllers\BovinoController;
use App\Http\Controllers\UnitProduccionController;
use App\Http\Controllers\PruebasController;
use App\Http\Controllers\GraficoController;
// LOG-IN
Route::get('/', function(){return view('index');});
Route::get('/privada', [GraficoController::class, 'mostrarGraficoRazas'])->middleware('auth')->name('privada');
Route::get('/login', [PropietarioController::class, 'showLoginForm'])->name('login');
Route::post('/login', [PropietarioController::class, 'login'])->name('login.attempt');
Route::post('/logout', [PropietarioController::class, 'logout'])->name('logout');
// PERFIL
Route::get('/propietarios/create', [PropietarioController::class, 'create'])->name('propietarios.create');
Route::post('/propietarios', [PropietarioController::class, 'store'])->name('propietarios.store');
Route::put('/perfil/actualizar', [PropietarioController::class, 'update'])->name('propietario.update');
Route::get('/perfil/propietario', [PropietarioController::class, 'edit'])->name('propietarios.edit');
Route::get('/perfil', [PropietarioController::class, 'perfil'])->name('propietarios.perfil');
// BOVINOS
Route::resource('bovinos', BovinoController::class);
Route::get('/bovinos/create', [BovinoController::class, 'create'])->name('bovinos.create');
Route::get('/bovinos/bovinos', [BovinoController::class, 'show'])->name('bovinos.bovinos');
Route::get('/bovinos/reg', [BovinoController::class, 'create'])->name('bovinos.bovinos');
Route::delete('/bovinos/{bovino}', [BovinoController::class, 'destroy'])->name('bovinos.destroy');
Route::get('edit/{bovino}', [BovinoController::class, 'edit'])->name('bovinos.edit');
// UNIDADES DE PRODUCCION
Route::get('/unidad_de_produccion', [UnitProduccionController::class, 'index'])->name('propietario.unit');
Route::get('/unidad_de_produccion/create', [UnitProduccionController::class, 'create'])->name('propietario.createunit');
Route::post('/unidad_de_produccion', [UnitProduccionController::class, 'store'])->name('unidad_de_produccion.store');
Route::delete('/unidad_de_produccion/{prueba}', [UnitProduccionController::class, 'destroy'])->name('unidad_de_produccion.destroy');
Route::get('/unidad_de_produccion/edit', [UnitProduccionController::class, 'edit'])->name('unidad_de_produccion.edit');
// PRUEBAS
Route::put('/pruebas/{prueba}/bovinos/actualizar-resultados', 'PruebasController@actualizarResultados')->name('pruebas.bovinos.actualizar_resultados');
Route::post('/agregar-detalles', [PruebasController::class,'agregarDetalles'])->name('agregar-detalles');
Route::get('pruebas/bovinos/{id}',  [PruebasController::class, 'nombreDelMetodo'])->name('pruebas.bovinos');
Route::get('/pruebas/pruebas', [PruebasController::class, 'index'])->name('pruebas.pruebas');
Route::get('/pruebas/registrar', [PruebasController::class, 'create'])->name('pruebas.registrar');
Route::post('/pruebas', [PruebasController::class, 'store'])->name('pruebas.store');
Route::get('/pruebas/{prueba}/edit', [PruebasController::class, 'edit'])->name('pruebas.edit');
Route::put('/pruebas/{prueba}', [PruebasController::class, 'update'])->name('pruebas.update');
Route::delete('/pruebas/{prueba}', [PruebasController::class, 'destroy'])->name('pruebas.destroy');