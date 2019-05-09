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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::group(["middleware" => "auth"], function () {

    Route::get('/home', 'HomeController@index');

    Route::resource('books', 'BookController');

    Route::resource('users', 'UserController');

    Route::resource('activeCarts', 'ActiveCartController');

    Route::resource('activeOrders', 'ActiveOrderController');

    Route::resource('authors', 'AuthorController');

    Route::resource('bookEditions', 'BookEditionController', [
        'only' => ['index', 'store', 'create']
    ]);

    Route::resource('bookEditions/{book_id}/bookEditions', 'BookEditionController', [
        'except' => ['index', 'store', 'create']
    ]);

    Route::resource('bookIsbns', 'BookIsbnController',[
        'only' => ['index', 'store', 'create']
    ]);

    Route::resource('bookIsbns/{book_id}/bookIsbns', 'BookIsbnController',[
        'except' => ['index', 'store', 'create']
    ]);

    Route::resource('historyOrders', 'HistoryOrderController');

    Route::resource('items', 'ItemController');

    Route::resource('publishers', 'PublisherController');

    Route::resource('purchaseHistories', 'PurchaseHistoryController');

    Route::resource('roleCredentials', 'RoleCredentialController');

    Route::resource('statistics', 'StatisticController');

    Route::resource('authorBooks', 'AuthorBookController', [
        'only' => ['index', 'store', 'create']
    ]);

    Route::resource('authorBooks/{book_id}/authorBooks', 'AuthorBookController', [
        'except' => ['index', 'store', 'create']
    ]);
});