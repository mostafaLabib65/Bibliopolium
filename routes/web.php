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

Route::get('/home', 'HomeController@index');

Route::resource('books', 'BookController');

Route::resource('users', 'UserController');

Route::resource('activeCarts', 'ActiveCartController');

Route::resource('activeOrders', 'ActiveOrderController');

Route::resource('authors', 'AuthorController');

Route::resource('bookEditions', 'BookEditionController',[
    'only' => ['index','create']
]);

Route::resource('bookEditions/{book_id}/bookEditions', 'BookEditionController',[
    'except' => ['index','create']
]);

Route::resource('bookIsbns', 'BookIsbnController');

Route::resource('historyOrders', 'HistoryOrderController');

Route::resource('items', 'ItemController');

Route::resource('publishers', 'PublisherController');

Route::resource('purchaseHistories', 'PurchaseHistoryController');

Route::resource('roleCredentials', 'RoleCredentialController');

Route::resource('statistics', 'StatisticController');