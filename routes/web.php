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
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');//->middleware('verified');

Route::get('/redirect/{service}','SocialController@redirect')->name('redirect');
Route::get('/callback/{service}','SocialController@callback')->name('callback');

Route::get('fillable', 'CrudController@getOffers');


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ],
], function () {
    Route::group(['prefix' => 'offers'], function () {
        Route::get('create', 'CrudController@create')->name('offer-create');
        Route::post('store', 'CrudController@store')->name('offer-store');
        Route::get('all', 'CrudController@getAllOffers');
    });

});
