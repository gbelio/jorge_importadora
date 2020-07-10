<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

Auth::routes();

Route::get('/','ProductController@showAll');

Route::get('/faq','FaqController@index');

Route::group(['prefix'=>'profile'], function(){
    
    Route::get('/','ProfileController@index');
    Route::get('/{id}','ProfileController@show');
});

//Categorias

Route::group(['prefix'=>'categorias'], function(){

    Route::get('/busqueda','CategoryController@search'); //Busca la categoría seleccionada del dropdown y te muestra los productos relacionados
    Route::get('/cargar','CategoryController@create'); //va a llevar al formulario de carga de categoria (solo administrador)
    Route::post('/cargar','CategoryController@store'); //va a guardar el categoria en la base de datos (solo administrador)
    Route::get('/{id}','CategoryController@show');
    Route::patch('/{id}/editar','CategoryController@update'); //va a editar en la base de datos
});

//SubCategorias

Route::group(['prefix'=>'subcategorias'], function(){

    Route::get('/cargar','SubcategoryController@create'); //al formulario de carga de subcategoria (solo administrador)
    Route::post('/cargar','SubcategoryController@store'); //va a guardar el subcategoria en la base de datos (solo administrador)
    Route::patch('/{id}/editar','SubcategoryController@update'); //va a editar en la base de datos
    Route::get('/busqueda','SubcategoryController@search'); //Busca la subcategoría seleccionada del dropdown y te muestra los productos relacionados
});

//Slider

Route::group(['prefix'=>'slider'], function(){

    Route::get('/cargar','SliderController@create'); //al formulario de carga de subcategoria (solo administrador)
    Route::post('/cargar','SliderController@store'); //va a guardar el subcategoria en la base de datos (solo administrador)
    Route::patch('/{id}/editar','SliderController@update'); //va a editar en la base de datos
});

//Productos

Route::group(['prefix'=>'productos'], function(){

    Route::get('/busqueda','ProductController@search');    
    Route::get('/cargar','ProductController@create'); //va a llevar al formulario de carga de producto
    Route::post('/cargar','ProductController@store'); //va a guardar el producto en la base de datos
    Route::get('/categoria/{id}','ProductController@index'); //va a mostrar todos los productos segun el ID de categoria.    
    Route::get('/editar/{id}','ProductController@edit'); //va a llevar al formulario de edición
    Route::patch('/editar/{id}','ProductController@update'); //va a editar en la base de datos
    Route::delete('/editar/{id}','ProductController@destroy');
    Route::get('/','ProductController@showAll'); //va a mostrar las fotos y detalle de un producto
    Route::get('/{id}','ProductController@show'); //va a mostrar las fotos y detalle de un producto
});

//Multimedia

Route::get('/productos/usuario/cargar_imagen/{id}','MultimediaController@create');
Route::post('/productos/usuario/cargar_imagen/{id}','MultimediaController@store');
Route::get('/{id}/editar','MultimediaController@edit'); 
Route::patch('/{id}/editar','MultimediaController@update'); 
Route::delete('/productos/usuario/cargar_imagen/{id}','MultimediaController@destroy');

Route::get('logout','\App\Http\Controllers\Auth\LoginController@logout');

Route::resource('category','CategoryController');

Route::resource('subcategory','SubcategoryController');

Route::resource('sliders','SliderController');