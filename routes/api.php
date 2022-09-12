<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Orders\PaymentController;
use App\Http\Controllers\Api\Buy\BuySponsorController;


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

Route::get('/apartments', 'Api\ApartmentController@index')->name('api.apartments.index');
Route::get('/apartments/{slug}', 'Api\ApartmentController@show')->name('api.apartments.show');
Route::get('/extra_services', 'Api\ExtraServicesController@index')->name('api.services.index');
Route::post('/message', 'Api\MessageController@store')->name('api.message.post');
Route::get('/search/apartments', 'Api\ApartmentController@userSearch')->name('api.apartments.search');
Route::get('/search/apartments_evidence', 'Api\ApartmentController@evidence')->name('api.apartments.search');

Route::get('orders/generate','Api\Orders\PaymentController@generate' );
Route::post('payment/{apartment}','Api\Orders\PaymentController@makePayment')->name('api.orders.payment');
