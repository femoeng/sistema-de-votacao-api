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

Route::resource('departamentos','DepartamentoController',['only' => ['index', 'show', 'store', 'destroy', 'update']]);
Route::resource('visitantes','VisitanteController',['only' => ['index', 'show', 'store', 'destroy', 'update']]);
Route::group(['prefix'=>'departamento'],function(){   
Route::resource('cursos','CursoController',['only' => ['index', 'show', 'store', 'destroy', 'update']]);
Route::get('cursos','CursoController@indexByDepartamento');});
Route::resource('criterios','CriterioController',['only' => ['index', 'show', 'store', 'destroy', 'update']]);

Route::get('/', function () {
    return view('welcome');
});

