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
Route::resource('departamentos','DepartamentoController',['only' => ['index', 'show', 'store', 'destroy', 'update']]);

//Routas para Visitantes
Route::resource('visitantes','VisitanteController',['only' => ['index', 'show', 'store', 'destroy', 'update']]);

//Routas para cursos
Route::group(['prefix'=>'departamento'],function(){   
Route::resource('cursos','CursoController',['only' => ['index', 'show', 'store', 'destroy', 'update']]);
Route::get('cursos','CursoController@indexByDepartamento');});

//Routas para criterios
Route::resource('criterios','CriterioController',['only' => ['index', 'show', 'store', 'destroy', 'update']]);

//Routas para projectos
Route::resource('projectos','ProjectoController',['only' => ['index', 'show', 'store', 'destroy', 'update']]);

//Routas para projectistas
Route::resource('projectistas','ProjectistaController',['only' => ['index', 'show', 'store', 'destroy', 'update']]);

//Routas para criterios
Route::resource('criterios','CriterioController',['only' => ['index', 'show', 'store', 'destroy', 'update']]);

Route::get('/', function () {
    return view('welcome');
});

