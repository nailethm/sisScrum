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

Route::get('/', function () {
    return view('auth/login');
});
Route::get('/home', 'HomeController@index');
Route::get('/mistareas', 'HomeController@mistareas');

// Route::get('perfil/{idusuario}', ['as' => 'seguridad/usuario/{idusuario}/show', 'uses' => 'UsuarioController@show']);

Route::resource('/proyectos','ProyectoController');

Route::get('/proyectos/{idproyecto}/sprints', 'SprintController@index');
Route::get('/proyectos/{idproyecto}/sprints/create', 'SprintController@create');
Route::post('/proyectos/{idproyecto}/sprints', 'SprintController@store');
Route::get('/proyectos/{idproyecto}/sprints/{idsprint}/show', 'SprintController@show');
Route::get('/proyectos/{idproyecto}/sprints/{idsprint}/chartjs', 'SprintController@Chartjs');
Route::get('/proyectos/{idproyecto}/sprints/{idsprint}/edit', 'SprintController@edit');
Route::PATCH('/proyectos/{idproyecto}/sprints/{idsprint}/edit', 'SprintController@update');
Route::delete('/proyectos/{idproyecto}/sprints/{idsprint}', 'SprintController@destroy');

Route::get('/proyectos/{idproyecto}/backlog', 'BacklogController@index');
Route::post('/proyectos/{idproyecto}/sprints/{idsprint}/show', 'BacklogController@store');

Route::get('/proyectos/{idproyecto}/historias/create', 'HistoriaController@create');
Route::post('/proyectos/{idproyecto}/historias', 'HistoriaController@store');
Route::get('/proyectos/{idproyecto}/historias/{idhistoria}/show', 'HistoriaController@show');
Route::get('/proyectos/{idproyecto}/historias/{idhistoria}/edit', 'HistoriaController@edit');
Route::PATCH('/proyectos/{idproyecto}/historias/{idhistoria}/edit', 'HistoriaController@update');
Route::delete('/proyectos/{idproyecto}/historias/{idhistoria}', 'HistoriaController@destroy');

Route::get('/proyectos/{idproyecto}/historias/{idhistoria}/tareas', 'TareaController@index');
Route::get('/proyectos/{idproyecto}/historias/{idhistoria}/tareas/create', 'TareaController@create');
Route::post('/proyectos/{idproyecto}/historias/{idhistoria}/tareas', 'TareaController@store');
Route::get('/proyectos/{idproyecto}/historias/{idhistoria}/tareas/{idtarea}/edit', 'TareaController@edit');
Route::PATCH('/proyectos/{idproyecto}/historias/{idhistoria}/tareas/{idtarea}/edit', 'TareaController@update');
Route::delete('/proyectos/{idproyecto}/historias/{idhistoria}/tareas/{idtarea}', 'TareaController@destroy');
// Avances de tareas
Route::get('/proyectos/{idproyecto}/tareas/{idtarea}/avances', 'AvanceTareaController@index');
Route::get('/proyectos/{idproyecto}/tareas/{idtarea}/avances/create', 'AvanceTareaController@create');
Route::post('/proyectos/{idproyecto}/tareas/{idtarea}/avances', 'AvanceTareaController@store');
Route::get('/proyectos/{idproyecto}/tareas/{idtarea}/avances/{idavance}/edit', 'AvanceTareaController@edit');
Route::PATCH('/proyectos/{idproyecto}/tareas/{idtarea}/avances/{idavance}/edit', 'AvanceTareaController@update');
Route::delete('/proyectos/{idproyecto}/tareas/{idtarea}/avances/{idavance}', 'AvanceTareaController@destroy');

Route::resource('seguridad/usuario','UsuarioController');

Route::get('reporte/usuarios/{id}/pdf', 'PdfController@reporteUsuario');
	Route::post('reporte/usuarios/pdf', 'PdfController@reporteUsuarios');
Route::get('seguridad/reportes', 'PdfController@index');
	Route::get('reporte/proyectos/pdf', 'PdfController@reporteProyectos');

Route::get('/proyectos/{idproyecto}/participantes', 'AsignadoController@index');
Route::post('/proyectos/{idproyecto}/participantes', 'AsignadoController@store');
Route::delete('/proyectos/{idproyecto}/participantes/{idasignado}', 'AsignadoController@destroy');

// Route::get('pdf', 'PdfController@invoice');

Route::auth();