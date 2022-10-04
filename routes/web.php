<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'advertising'],function(){
    Route::get('/create', [App\Http\Controllers\advertisingController::class, 'create'])->name('create');

    Route::post('/Add', [App\Http\Controllers\advertisingController::class, 'add'])->name('add');

    Route::post('/JsonListAdvertising', [App\Http\Controllers\advertisingController::class, 'JsonListAdvertising'])->name('JsonListAdvertising');


    Route::get('/index', [App\Http\Controllers\advertisingController::class, 'index'])->name('index');


    Route::get('/edit/{advertising}', [App\Http\Controllers\advertisingController::class, 'edit'])->name('edit');

    Route::post('/update/{advertising}', [App\Http\Controllers\advertisingController::class, 'update'])->name('update');

    Route::get('/CallingImage/{advertising}', [App\Http\Controllers\advertisingController::class, 'CallingImage'])->name('CallingImage');

    Route::post('/delete/{advertising}', [App\Http\Controllers\advertisingController::class, 'delete'])->name('delete');


});

Auth::routes();

