<?php

//devuelve la vista principal
Route::get('/','controladorProductos@mostrarMenuyDestacados' ,function(){
    return view('master');
});

//devuelve la tabla de productos dependiendo de la categoria que se seleccione en el menu
Route::get('/productosMostrados/{categoria}','controladorProductos@menuHealthy');

//devuelve una pagina con los detalles de producto
Route::get('/detallesProducto/{idProducto}', 'controladorProductos@mostrarDetalles');

Route::get('detallesProducto', function(){
    return view('detallesProducto');
});




//Carrito de la compra
Route::get('/carrito', 'controladorCarrito@verCarrito');
Route::post('/carrito', 'controladorCarrito@addToCart')->name('cart.add');
Route::delete('/carrito/{id}','controladorCarrito@removeFromCart')->name('cart.remove');
Route::post('/actualizar', 'controladorCarrito@update')->name('update.carrito');


//LOGIN Y REGISTRO DE USUARIO
        
        //Auth::routes();   <-- Esta ruta es la que incluye todas las rutas de abajo referentes al login, registro etc

 // Authentication Routes...
 Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
 Route::post('login', 'Auth\LoginController@login');
 Route::post('logout', 'Auth\LoginController@logout')->name('logout');

 // Registration Routes...
 Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
 Route::post('register', 'Auth\RegisterController@register');

 // Password Reset Routes...
 Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
 Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
 Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
 Route::post('password/reset', 'Auth\ResetPasswordController@reset');

 Route::get('/home', 'HomeController@index')->name('home');


//FACTURACION

Route::get('/facturacion', 'controladorCarrito@showFacturacion')->name('mostrarFacturacion');
Route::post('/crearPedido', 'controladorPedidos@crearPedido')->name('crearPedido');
//Route::post('/resumenPedido', 'controladorPedidos@resumen')->name('resumenPedido');
Route::post('/pedidoRealizado', 'controladorPedidos@pedidoRealizado')->name('pedidoRealizado');
Route::post('/aceptar', 'controladorPedidos@aceptar')->name('aceptar');

//PERFIL DEL USUARIO

Route::get('/verPerfil', 'controladorPerfilUser@verPerfil')->name('verPerfil');
Route::post('/editarDatos', 'controladorPerfilUser@editarDatos')->name('editarDatos');
Route::get('/verPedidos', 'controladorPerfilUser@verPedidos')->name('verPedidos');

Route::post('/facturaPdf', 'controladorPerfilUser@facturaPDF')->name('facturaPdf');
Route::post('/darDeBaja', 'controladorPerfilUser@darBaja')->name('darDeBaja');