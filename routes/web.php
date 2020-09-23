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


Route::get('categorias','categoriasController@index');


Route::get('editorials','editorialsController@index');


Route::get('idiomas','idiomasController@index');


Route::get('pais','paisController@index');
