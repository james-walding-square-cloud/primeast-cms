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
    Route::get('/associate/profilePDF/{user_id}', ('AssociateController@profilePDF'));
    Route::put('/associate/update/{user_id}', ('AssociateController@update'));
    Route::get('/associate/deactivate/{user_id}', ('AssociateController@deactivate'));
    Route::get('/associate/create', ('AssociateController@create'));
    Route::post('/associate/store', ('AssociateController@store'));
    Route::get('/update/languages', ('AssociateController@languagesUpdate'));
    Route::get('/update/sectors', ('AssociateController@sectorsUpdate'));
    Route::get('/update/skills', ('AssociateController@skillsUpdate'));
    Route::get('/update/knownlanguages', ('AssociateController@knownLanguages'));


    //Banners
    Route::get('/banner/index', ('BannerController@index'));
    Route::get('/banner/edit/{banner_id}', ('BannerController@edit'));
    Route::get('/banner/create', ('BannerController@create'));
    Route::post('/banner/store', ('BannerController@store'));
    Route::put('/banner/imageUpdate/{user_id}', ('AssociateController@imageUpdate'));
    Route::get('/banner/deactivate/{user_id}', ('AssociateController@deactivate'));


});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
