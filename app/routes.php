<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});
Route::get('/graficas', function()
{
    return View::make('graficas');
});
//Route::model('trampa','ConfiguracionTrampa');

//Ubicaciones
Route::get('ubicacion/list','ConfiguracionTrampaController@getUbicaciones');

//trampa
Route::get('trampa','ConfiguracionTrampaController@index');
Route::get('/create','ConfiguracionTrampaController@create');
Route::get('trampa/GetCfgTrampa','ConfiguracionTrampaController@getConfiguracionTrampa');
//Eventos
Route::get('evento','EventoController@getIndex');
Route::get('evento/list','EventoController@getEventos');
Route::get('evento/GetDetail/{idevento}','EventoController@getDetail');



//POST
//Trampa
Route::post('/create', 'ConfiguracionTrampaController@handleCreate');
//Eventos
Route::post('/evento/create', 'EventoController@handleCreate');
Route::post('/eventoDetail/create', 'EventoController@EventoDetailCreate');