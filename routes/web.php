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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Faq
Route::get('/faq', function () {
    return view('faq');
})->name('faq');

// Requestor routes
Route::group(['middleware' => ['role:requestor|approver|admin']], function () {
    Route::get('/requests', 'RequestorController@index')->name('requests.index');
    Route::get('/requests/create', 'RequestorController@create')->name('requests.create');
    Route::post('/requests', 'RequestorController@store')->name('requests.store');
    Route::get('/requests/getapplicationtypes', 'RequestorController@getApplicationTypes')->name('requests.getapplicationtypes');
    Route::get('/requests/getrequesttypes', 'RequestorController@getRequestTypes')->name('requests.getrequesttypes');
});

// Approver routes
Route::group(['middleware' => ['role:approver']], function () {
    Route::get('/approvals', 'ApproverController@index')->name('approvals.index');
});
