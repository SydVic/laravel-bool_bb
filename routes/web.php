<?php

use Illuminate\Support\Facades\Auth;
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
Auth::routes();

Route::middleware('auth')
    ->namespace('User')
    ->name('user.')
    ->prefix('user')
    ->group(function() {
        Route::get('/', 'DashboardController@index')->name('dashboard');
        Route::resource('apartment', 'ApartmentController');
        Route::resource('message', 'MessageController');
        Route::get('message/{message}/apartment-messages', 'MessageController@apartmentMessages')->name('message.apartment-messages');
        Route::get('visual/{apartment}/views', 'ApartmentsViewController@index')->name('visual.views');
        Route::get('sponsor/{apartment}', 'SponsorController@index')->name('sponsor.index');
    });

// Route::get('{any?}', function(){
//     return view('welcome');
// })->where('any', '.*');
Route::get('{any?}', function(){
    return view('guest.home');
})->where('any', '.*');