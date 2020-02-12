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

//LOGIN
Route::get('login','UserController@mostrarLogin');
Route::post('login','controladorLogin@login', function(){
    return view('master');
})->name('login.inicioSesion');


//Carrito de la compra
Route::get('/carrito', 'controladorCarrito@verCarrito');

Route::post('/carrito', 'controladorCarrito@addToCart')->name('cart.add');

Route::delete('/carrito/{id}','controladorCarrito@removeFromCart')->name('cart.remove');

Route::post('/actualizar', 'controladorCarrito@update')->name('update.carrito');





















//productos de la categoria menu healthy
Route::get('/healthy', 'controladorProductos@menuHealthy');

//productos de la categoria menu executive
Route::get('/executive', 'controladorProductos@menuExecutive');


//mostrar los productos de una determinada categoria
Route::get('/prueba', 'controladorProductos@mostrarProductos');

