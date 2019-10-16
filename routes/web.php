<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/partida', ['uses' => 'Partida@index']);

Route::post('/partida', ['uses' => 'Partida@dadosDaRodada']);

Route::get('/cadastro_de_times', function () {
    return view('cadastro_de_times');
});

Route::post('/cadastrar', ['uses' => 'Cadastro@cadastroDeTimes']);