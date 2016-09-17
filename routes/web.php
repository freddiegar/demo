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

Route::get('/', function () {
    /*
     | Controlador por defecto
    */ 
    return redirect('/transaction/index');
});
/*
 | Consultar mediante ajax los tipos de documentos disponibles.
 | Utilizado en transaction/create.blade.php
*/ 
Route::post('/documentTypes/get', 'DocumentTypeController@get');

/*
 | Consultar mediante ajax los tipos banca disponibles.
 | Utilizado en transaction/create.blade.php
*/ 
Route::post('/personType/get', 'PersonTypeController@get');
/*
 | Consultar mediante ajax los bancos disponibles.
 | Utilizado en transaction/create.blade.php
*/ 
Route::post('/bank/get', 'BankController@get');

// Manejode transacciones (Sintaxis simplicafada cuando se usa --resource) 
Route::get('/transaction/index', 'TransactionController@index');
Route::get('/transaction/create', 'TransactionController@create');
Route::post('/transaction/store', 'TransactionController@store');

// Manejo de los bancos (Sintaxis detallada cuando se usa --resource) 
Route::post('/country/get', 'CountryController@get');
Route::get('/country/index', 'CountryController@index');
Route::get('/country/create', 'CountryController@create');
Route::post('/country/store', 'CountryController@store');
Route::get('/country/{id}/edit', 'CountryController@edit');
Route::put('/country/update/{id}', 'CountryController@update');
Route::delete('/country/delete/{id}', 'CountryController@destroy');

/*
 | Mostrar ventana de resultado de la operacion
 | Utilizado en transaction/response.blade.php
*/ 
Route::any('/transaction/response', function (){
    return view('transaction/response');
});
/*
 | Solicitar el estado de una nueva transaccion
 | Utilizado en transaction/response.blade.php
*/ 
Route::match(['get', 'post'], '/transaction/status', 'TransactionController@status');


