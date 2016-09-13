<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
| Avalible
| Route::get($uri, $callback);
| Route::post($uri, $callback);
| Route::put($uri, $callback);
| Route::patch($uri, $callback);
| Route::delete($uri, $callback);
| Route::options($uri, $callback);
| Route::match(['get', 'post'], '/', function () {
|     //
| });
| Route::any('foo', function () {
|     //
| });
*/

/*
 | Mostrar el formulario de compra
*/ 
Route::get('/', function () {
    return view('buy');
});
Route::get('/buy', function () {
    return view('buy');
});
/*
 | Consultar mediante ajax los tipos de documentos disponibles.
 | Utilizado en buy.blade.php
*/ 
Route::match(['get', 'post'], '/documentTypes', 'DocumentTypeController@get');
/*
 | Consultar mediante ajax los paises disponibles.
 | Utilizado en buy.blade.php
*/ 
Route::match(['get', 'post'], '/country', 'CountryController@get');
/*
 | Consultar mediante ajax los tipos banca disponibles.
 | Utilizado en buy.blade.php
*/ 
Route::match(['get', 'post'], '/personType', 'PersonTypeController@get');
/*
 | Consultar mediante ajax los bancos disponibles.
 | Utilizado en buy.blade.php
*/ 
Route::match(['get', 'post'], '/bank', 'BankController@get');
/*
 | Solicitar creacion de una nueva transaccion
 | Utilizado en buy.blade.php
*/ 
Route::match(['get', 'post'], '/getTransaction', 'TransactionController@getTransaction');

/*
 | Mostrar ventana de resultado de la operacion
 | Utilizado en response.blade.php
*/ 
Route::any('/response', function (){
    return view('response');
});
/*
 | Solicitar el estado de una nueva transaccion
 | Utilizado en response.blade.php
*/ 
Route::match(['get', 'post'], '/getTransactionInfo', 'TransactionController@getTransactionInfo');


