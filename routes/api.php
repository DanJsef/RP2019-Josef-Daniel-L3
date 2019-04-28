<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//NO RESTRICTION
//USER
Route::post('/user/sign-up', [
    'uses' => 'UserController@signUp'
]);
Route::post('/user/sign-in', [
    'uses' => 'UserController@signIn'
]);
Route::post('/user/data', [
    'uses' => 'UserController@getUserData'
]);
Route::get('/user/verify/{token}', [
    'uses' => 'UserController@verify'
]);
Route::post('/user/forgot-password', [
    'uses' => 'UserController@forgotPassword'
]);
Route::post('/user/reset-password', [
    'uses' => 'UserController@resetPassword'
]);
//ADMIN
Route::post('/admin', [
    'uses' => 'AdminController@signIn'
]);
Route::post('/admin/data', [
    'uses' => 'AdminController@getAdminData'
]);
//TEXT
Route::get('/text/index', [
    'uses' => 'TextController@getText'
]);
//GALLERY
Route::get('/photo/index', [
    'uses' => 'PhotosController@getPhotos'
]);

//ADMIN RESTRICTED
Route::middleware('api.admin')->group(function () {
    //TEXT
    Route::post('/text/update', [
        'uses' => 'TextController@updateText'
    ]);
    //BOOKING
    Route::post('/booking/remove', [
        'uses' => 'BookingController@RemoveReserved'
    ]);
    Route::post('/booking/reserved', [
        'uses' => 'BookingController@Reserved'
    ]);
    //GALLERY
    Route::post('/photo/add', [
        'uses' => 'PhotosController@storePhoto'
    ]);
    Route::post('/photo/delete', [
        'uses' => 'PhotosController@deletePhoto'
    ]);
});

//USER RESTRICTED
Route::middleware('api.user')->group(function () {
    //BOOKING
    Route::post('/booking/index/krasna-lipa', [
        'uses' => 'BookingController@indexKrasnaLipa'
    ]);
    Route::post('/booking/index/liberec', [
        'uses' => 'BookingController@indexLiberec'
    ]);
    Route::post('/booking/reserve', [
        'uses' => 'BookingController@Reserve'
    ]);
});