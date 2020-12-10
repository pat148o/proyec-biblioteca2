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
// ::::::::::::::
// 1. creo las rutas






Route::get('/','Auth\LoginController@mostrarLogin');
Route::post('/login','Auth\LoginController@login')->name('login');


// Route::post('/logout','Auth\LoginController@logout')->name('logout');

Route::post('/logout','Auth\LoginController@logout')->name('logout');

Route::get('/main', function () {
    return view('contenido/contenido');
})->name('main');



Route::get('users','usersController@index');
// Route::get('getuser','UserController@getUser');
Route::post('/users/registrar','usersController@store');
Route::put('/users/actualizar','UsersController@update');
Route::post('/users/eliminar','usersController@destroy');


Route::get('autors','autorsController@index');
Route::get('getaut','autorsController@getAutor');
Route::post('/autors/registrar','autorsController@store');
Route::put('/autors/actualizar','autorsController@update');
Route::post('/autors/eliminar','autorsController@destroy');




Route::get('categoria','categoriasController@index');
Route::get('getcat','categoriasController@getCategorias');
Route::post('/categorias/registrar','categoriasController@store');
Route::put('/categorias/actualizar','categoriasController@update');
Route::post('/categorias/eliminar','categoriasController@destroy');


Route::get('editorials','editorialsController@index');
Route::get('getedit','editorialsController@getEditorials');
Route::post('/editorials/registrar','editorialsController@store');
Route::put('/editorials/actualizar','editorialsController@update');
Route::post('/editorials/eliminar','editorialsController@destroy');


Route::get('idioma','idiomasController@index');
Route::get('getidi','idiomasController@getIdiomas');
Route::post('/idioma/registrar','idiomasController@store');
Route::put('/idioma/actualizar','idiomasController@update');
Route::post('/idioma/eliminar','idiomasController@destroy');  


Route::get('pais','paisController@index');
Route::get('getpai','paisController@getPais');
Route::post('/pais/registrar','paisController@store');
Route::put('/pais/actualizar','paisController@update');
Route::post('/pais/eliminar','paisController@destroy');

Route::get('personas','personasController@index');
Route::get('getpersona','personasController@getPersona');
Route::post('/personas/registrar','personasController@store'); 
Route::put('/personas/actualizar','personasController@update'); 
Route::post('/personas/eliminar','personasController@destroy');



Route::get('libros','librosController@index');
Route::get('getlibro','librosController@getLibro');
Route::post('/libro/registrar','librosController@store');
Route::put('/libro/actualizar','librosController@update');
Route::post('/libro/eliminar','librosController@destroy');





Route::get('solicitudes','SolicitudesController@index');
Route::post('/solicitudes/registrar','solicitudesController@store');
Route::post('/solicitudes/eliminar','solicitudesController@destroy');

Route::get('detsolicitudes','DetSolicitudesController@index');