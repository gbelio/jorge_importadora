<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

Auth::routes();

Route::get('/', 'ProductController@showAll');

//Categorias
Route::group(['prefix' => 'categorias'], function () {
    Route::get('/busqueda', 'CategoryController@search'); //Busca la categoría seleccionada del dropdown y te muestra los productos relacionados
    Route::get('/cargar', 'CategoryController@create'); //va a llevar al formulario de carga de categoria (solo administrador)
    Route::post('/cargar', 'CategoryController@store'); //va a guardar el categoria en la base de datos (solo administrador)
    Route::get('/{id}', 'CategoryController@show');
    Route::patch('/{id}/editar', 'CategoryController@update'); //va a editar en la base de datos
    Route::delete('/delete/{id}', 'CategoryController@destroy');
});

//SubCategorias
Route::group(['prefix' => 'subcategorias'], function () {
    Route::get('/index', 'SubcategoryController@getSubcategories'); //muestra todas las subcategorías
    Route::get('/cargar', 'SubcategoryController@create'); //al formulario de carga de subcategoria (solo administrador)
    Route::post('/cargar', 'SubcategoryController@store'); //va a guardar el subcategoria en la base de datos (solo administrador)
    Route::patch('/{id}/editar', 'SubcategoryController@update'); //va a editar en la base de datos
    Route::get('/busqueda', 'SubcategoryController@search'); //Busca la subcategoría seleccionada del dropdown y te muestra los productos relacionados
    Route::delete('/delete/{id}', 'SubcategoryController@destroy');
});

//Slider
Route::group(['prefix' => 'slider'], function () {
    Route::get('/cargar', 'SliderController@create'); //al formulario de carga de subcategoria (solo administrador)
    Route::post('/cargar', 'SliderController@store'); //va a guardar el subcategoria en la base de datos (solo administrador)
    Route::patch('/{id}/editar', 'SliderController@update'); //va a editar en la base de datos
    Route::delete('/delete/{id}', 'SliderController@destroy');
});

//Productos
Route::group(['prefix' => 'productos'], function () {
    Route::get('/busqueda', 'ProductController@search');
    Route::get('/cargar', 'ProductController@create'); //va a llevar al formulario de carga de producto
    Route::post('/cargar', 'ProductController@store'); //va a guardar el producto en la base de datos
    Route::get('/categoria/{id}', 'ProductController@index'); //va a mostrar todos los productos segun el ID de categoria.
    Route::get('/editar/{id}', 'ProductController@edit'); //va a llevar al formulario de edición
    Route::patch('/editar/{id}', 'ProductController@update'); //va a editar producto en la base de datos
    Route::post('/colores/editar/{id}', 'ProductController@editColour'); //va a editar producto en la base de datos
    Route::delete('/colores/eliminar/{id}', 'ProductController@deleteColour'); //va a editar producto en la base de datos
    Route::delete('/delete/{id}', 'ProductController@destroy'); //va a eliminar producto en la base de datos
    Route::get('/', 'ProductController@showAll'); //va a mostrar las fotos y detalle de un producto
    Route::get('/{id}', 'ProductController@show'); //va a mostrar las fotos y detalle de un producto
});

//Colores
Route::group(['prefix' => 'colores'], function () {
    Route::get('/cargar', 'ColourController@create'); //va a llevar al formulario de carga de colores
    Route::get('/{id}/editar', 'ColourController@edit');
    Route::post('/cargar', 'ColourController@store'); //va a guardar el color en la base de datos
    Route::delete('/delete/{id}', 'ColourController@destroy'); //va a eliminar color en la base de datos
    Route::patch('/{id}/editar', 'ColourController@update'); //va a editar en la base de datos
});

//Multimedia
Route::get('/productos/usuario/cargar_imagen/{id}', 'MultimediaController@create');
Route::post('/productos/usuario/cargar_imagen/{id}', 'MultimediaController@store');
Route::get('/{id}/editar', 'MultimediaController@edit');
Route::patch('/{id}/editar', 'MultimediaController@update');
Route::get('/editar/{id}', 'MultimediaController@create1'); //va a llevar al formulario de edición
Route::post('/editar/{id}', 'MultimediaController@store1'); //va a editar en la base de datos
Route::delete('/productos/usuario/cargar_imagen/{id}', 'MultimediaController@destroy');
Route::delete('/productos/editar/{id}', 'MultimediaController@destroy1');

//Perfil
Route::get('/perfil', 'ProfileController@edit'); //va a llevar al formulario de edición
Route::patch('/perfil', 'ProfileController@update'); //va a editar en la base de datos
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout'); //va a cerrar sesión
Route::get('/perfil/{id}', 'ProfileController@show'); //va a mostrar los datos de un usuario.


//Recursos
Route::resource('category', 'CategoryController');
Route::resource('subcategory', 'SubcategoryController');
Route::resource('sliders', 'SliderController');

//Ordenes
Route::get('/order', 'OrderDetailController@index')->middleware('auth'); //Va a mostrar el detalle de las ordenes
Route::post('/order/{id}', 'OrderDetailController@add')->middleware('auth'); //Va a agregar un producto al detalle de la orden
Route::patch('/order', 'OrderDetailController@update')->middleware('auth'); //Va a editar el detalle de la orden
Route::get('/order/remove/{id}', 'OrderDetailController@destroy')->middleware('auth'); //Va a eliminar un producto del detalle de la orden

//Cart
Route::get('/cart', 'OrderDetailController@index')->middleware('auth'); //Muestra carrito
Route::post('/cart/{id}', 'OrderDetailController@add')->middleware('auth'); //Agrega producto al carrito
Route::patch('/cart', 'OrderDetailController@update')->middleware('auth'); //Actualiza carrito
Route::get('/cart/remove/{id}', 'OrderDetailController@destroy')->middleware('auth'); //Elimina producto del carrito

//Compras
Route::get('/compras', 'OrderController@index')->middleware('auth'); //muestra las compras de los usuarios.
Route::get('/compras/detalle/{id}', 'OrderController@show')->middleware('auth'); //Muestra el detalle de la compra.
Route::get('/compras/usuarios', 'OrderController@showAll')->middleware('admin'); //Muestra el detalle de la compra.
Route::get('/compras/busqueda', 'OrderController@search')->middleware('admin'); //Busca una compra.
Route::patch('/status', 'OrderController@update')->middleware('auth'); //genera una orden de compra.
Route::patch('/orderStatus', 'OrderController@updateStatus')->middleware('admin'); //actualiza el estado del pedido desde "Preparando" hasta "Finalizado".
