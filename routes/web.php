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
    Route::get('activeCarts/checkout/{id}', 'ActiveCartController@check')->name('activeCarts.check');
    Route::post('activeCarts/checkout/{id}', 'ActiveCartController@checkout')->name('activeCarts.checkout');

    Route::resource('activeOrders', 'ActiveOrderController');

    Route::resource('authors', 'AuthorController');

    Route::resource('bookEditions', 'BookEditionController', [
        'only' => ['index', 'create']
    ]);

    Route::resource('bookEditions/{book_id}/bookEditions', 'BookEditionController', [
        'except' => ['index', 'create']
    ]);

    Route::resource('bookIsbns', 'BookIsbnController');

    Route::resource('historyOrders', 'HistoryOrderController');

    Route::resource('items', 'ItemController', [
        'only' => ['index', 'create','store']
    ]);

    Route::resource('cart/{cart_id}/edition/{edition}/items', 'ItemController', [
        'except' => ['index', 'create','store']
    ]);

    Route::resource('publishers', 'PublisherController');

    Route::resource('purchaseHistories', 'PurchaseHistoryController');

    Route::resource('roleCredentials', 'RoleCredentialController');

    Route::resource('statistics', 'StatisticController');
});