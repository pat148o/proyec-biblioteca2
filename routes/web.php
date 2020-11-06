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


// route::get('plantilla', function () {
//     return view('plantilla');
// });

route::get('/', function () {
    return view('contenido/contenido');
});
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


Route::get('libros','librosController@index');
Route::get('getlibro','librosController@getLibro');
Route::post('/libro/registrar','librosController@store');
Route::put('/libro/actualizar','librosController@update');
Route::post('/libro/eliminar','librosController@destroy');

Route::get('getpersona','personasController@getPersona');

Route::get('solicitud','solicitudesController@index');
Route::post('/solicitud/registrar','solicitudesController@store');
Route::post('/solicitud/eliminar','solicitudesController@destroy');