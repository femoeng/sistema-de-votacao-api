<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Routas para departamentos
$read_write = [
  'only' => [
    'index',
    'show',
    'store',
    'destroy',
    'update'
  ]
];
Route::resource('departamentos','DepartamentoController', $read_write);

//Routas para cursos
Route::resource('departamentos.cursos','CursoController', $read_write);

//Routas para Visitantes
Route::resource('visitantes','VisitanteController', $read_write);

//Routas para projectos
Route::resource('projectos','ProjectoController', $read_write);

//Routas para projectistas
Route::resource('projectistas','ProjectistaController', $read_write);

//Routas para criterios
Route::resource('criterios','CriterioController', $read_write);
