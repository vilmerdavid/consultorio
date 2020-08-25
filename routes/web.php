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


Auth::routes(['register'=>false]);


Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('home');
    });
    
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/sintomas', 'Sintomas@index')->name('sintomas');
    Route::post('/sintomas-actualizar', 'Sintomas@actualizar')->name('actualizarSintoma');
    Route::get('/crear-hc', 'HistoriaClinicas@crear')->name('crearhc');
    Route::get('/hc', 'HistoriaClinicas@index')->name('hc');

    Route::post('/h-c-caclular-enfermedad', 'HistoriaClinicas@calcularEnfermedad')->name('calcularEnfermedad');
    Route::post('/h-c-guardar', 'HistoriaClinicas@guardarHc')->name('guardarHc');
    Route::get('/h-c-certificado/{id}', 'HistoriaClinicas@certificado')->name('certificadoHc');
    Route::post('/h-c-actualizar-certificado', 'HistoriaClinicas@actualizarCertificadoHc')->name('actualizarCertificadoHc');
    Route::get('/h-c-detalle/{id}', 'HistoriaClinicas@detalleHc')->name('detalleHc');
    Route::post('/h-c-actualizar', 'HistoriaClinicas@actualizarHc')->name('actualizarHc');
    Route::get('/h-c-pdf/{id}', 'HistoriaClinicas@hcPdf')->name('hcPdf');


});


