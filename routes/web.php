<?php

/**
 * Ruta para la vista principal
 */
Route::get('/','controladorProductos@mostrarMenuyDestacados' ,function(){
    return view('master');
});

/**
 * Ruta para devolver los productos mostrados segun categoria
 */
Route::get('/productosMostrados/{categoria}','controladorProductos@menuHealthy');

/**
 * Rutas para la vista de detalles del producto
 */
Route::get('/detallesProducto/{idProducto}', 'controladorProductos@mostrarDetalles');
Route::get('detallesProducto', function(){
    return view('detallesProducto');
});




/**
 * Rutas del carrito de la compra
 */
Route::get('/carrito', 'controladorCarrito@verCarrito')->name('carrito');
Route::post('/carrito', 'controladorCarrito@addToCart')->name('cart.add');
Route::delete('/carrito/{id}','controladorCarrito@removeFromCart')->name('cart.remove');
Route::post('/actualizar', 'controladorCarrito@update')->name('update.carrito');
Route::get('vaciarCarrito', 'controladorCarrito@vaciar')->name('vaciarCarrito');
Route::get('/seguirComprando', function(){
    return redirect('/');
})->name('seguirComprando');


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



/**
 * Rutas facturacion
 */
Route::post('/facturacion', 'controladorCarrito@showFacturacion')->name('mostrarFacturacion');
//Route::post('/crearPedido', 'controladorPedidos@crearPedido')->name('crearPedido');
Route::post('/pedidoRealizado', 'controladorPedidos@pedidoRealizado')->name('pedidoRealizado');
Route::post('/aceptar', 'controladorPedidos@aceptar')->name('aceptar');
Route::post('cancelarPedido', 'controladorPedidos@cancelarPedido')->name('cancelarPedido');


/**
 * Rutas pertenecientes al perfil del usuario
 */
Route::get('/verPerfil', ['middleware'=>'auth', 'uses' =>'controladorPerfilUser@verPerfil'])->name('verPerfil');
Route::post('/editarDatos',['middleware'=>'auth', 'uses' => 'controladorPerfilUser@editarDatos'])->name('editarDatos');
Route::get('/verPedidos', ['middleware'=>'auth', 'uses' =>'controladorPerfilUser@verPedidos'])->name('verPedidos');
Route::get('/vistaEditar',['middleware'=>'auth', 'uses' => 'controladorPerfilUser@editarForm'])->name('vistaEditar');
Route::post('/facturaPdf', ['middleware'=>'auth', 'uses' =>'controladorPerfilUser@facturaPDF'])->name('facturaPdf');
Route::post('/cambioClave', ['middleware'=>'auth', 'uses' =>'controladorPerfilUser@cambioClave'])->name('cambioClave');
Route::post('/darDeBaja', ['middleware'=>'auth', 'uses' =>'controladorPerfilUser@darBaja'])->name('darDeBaja');
Route::get('confirmacionBaja', 'controladorPerfilUser@confirmacionBaja')->name('confirmacionBaja');

//CONVERSION XML

Route::post('/vista', 'controladorPerfilUser@exportarPedidos')->name('verXML');
Route::get('/exportarProductos', 'controladorPerfilUser@exportarProductos')->name('exportarProductos');



/**
 * Rutas pertenecientes al pago con PayPal
 */
Route::get('payment', array(
    'as' => 'payment',
    'uses' => 'PaypalController@postPayment',
));

Route::get('payment/status', array(
    'as' => 'payment.status',
    'uses' => 'PaypalController@getPaymentStatus',
));