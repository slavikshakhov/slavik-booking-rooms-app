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

Route::apiResource('rooms', 'Api\RoomController')->only(['index', 'show']);

Route::get('rooms/{room}/availability', 'Api\RoomAvailabilityController')->name(
    'rooms.availability.show'
);

Route::get('rooms/{room}/reviews', 'Api\RoomReviewController')->name(
    'rooms.reviews.index'
);
Route::get('rooms/{room}/price', 'Api\RoomPriceController')->name(
    'rooms.price.show'
);
Route::get(
    '/booking-by-review/{reviewKey}',
    'Api\BookingByReviewController'
)->name('booking.by-review.show');

Route::apiResource('reviews', 'Api\ReviewController')->only(['show', 'store']);
Route::post('checkout', 'Api\CheckoutController')->name('checkout');
