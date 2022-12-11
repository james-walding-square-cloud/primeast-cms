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
    return view('auth/login');
});

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    //Associate
    Route::get('/associate/index', ('AssociateController@index'));
    Route::get('/associate/edit/{user_id}', ('AssociateController@edit'));
    Route::get('/associate/profile/{user_id}', ('AssociateController@profile'));
    Route::put('/associate/profileUpdate/{user_id}', ('AssociateController@profileUpdate'));
    Route::put('/associate/update/{user_id}', ('AssociateController@update'));
    Route::get('/associate/create', ('AssociateController@create'));
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
