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
    return view('requestor.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Requestor routes
Route::group(['middleware' => ['role:Requestor|Approver|Admin']], function () {
    Route::get('/requests', 'RequestorController@index')->name('requests.index');
});

// Approver routes
Route::group(['middleware' => ['role:Approver']], function () {
    Route::get('/approvals', 'ApproverController@index')->name('approvals.index');
});
