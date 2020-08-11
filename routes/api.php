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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*
Route::get('bookables', 'Api\BookableController@index');
Route::apiResource('els', 'Api\ElsController')->only(['index', 'show']);
Route::get('els', 'Api\ElsController');
Route::get('els/{el}/x', 'Api\ElXController')->name('els.x.show');   //sg action controller 
Route::get('els/{el}/xs', 'Api\ElXController')->name('els.xs.index');
*/
