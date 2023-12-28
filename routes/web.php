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
    Route::get('/requests/generateticketid', 'RequestorController@generateTicketId')->name('requests.generateticketid');
});

// Approver routes
Route::group(['middleware' => ['role:approver']], function () {
    Route::get('/approvals', 'ApproverController@index')->name('approvals.index');
});

// SeusRoutes(admin routes)
Route::get('dashboard', function () {
    return view('admin.dashboard');
});
/* 
Route::get('/register', function () {
    return view('admin.register');
}); */

Route::get('/forms', 'AccountController@index');


Route::get('/test', function () {
    return view('test');
});

// Route::get('users', function () {
//     return view('admin.users');
// });

// Route::get('approvers', function () {
//     return view('admin.approvers');
// });

Route::get('/administrator', 'AdminController@index');
Route::get('/users', 'UsersController@index');
Route::get('/request', 'RequestsController@index');
Route::get('/prices', 'AccountChangesController@index');
