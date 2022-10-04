<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix'=>'advertising'],function(){
  
    Route::post('/Add', [App\Http\Controllers\advertisingController::class, 'add'])->name('add');

    Route::post('/JsonListAdvertising', [App\Http\Controllers\advertisingController::class, 'JsonListAdvertising'])->name('JsonListAdvertising');

    Route::post('/update/{advertising}', [App\Http\Controllers\advertisingController::class, 'update'])->name('update');

    Route::post('/delete/{advertising}', [App\Http\Controllers\advertisingController::class, 'delete'])->name('delete');


});
