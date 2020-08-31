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


define('PAGINATION_COUNT',5);

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
    'middleware' => [ 'auth', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ],
], function () {
    Route::group(['prefix' => 'offers'], function () {
        Route::get('create', 'CrudController@create')->name('offer-create');
        Route::post('store', 'CrudController@store')->name('offer-store');
        Route::get('edit/{offer_id}', 'CrudController@editOffer')->name('offer-edit');
        Route::post('update/{offer_id}', 'CrudController@updateOffer')->name('offer-update');
        Route::get('delete/{offer_id}','CrudController@deleteOffer')->name('offer-delete');
        Route::get('all', 'CrudController@getAllOffers')->name('offer-all');
        Route::get('get-all-inactive-offers', 'CrudController@getInactiveOffer');
    });

    Route::get('youtube', 'CrudController@getVideo')->name('getVideo')->middleware('auth');

});


///////////////////////Begain Ajax Routes////////////////////////////
Route::group(['prefix' => 'ajax-offers'], function () {
    Route::get('create', 'OfferController@create')->name('ajax.Offer.create');
    Route::post('store', 'OfferController@store')->name('ajax.Offer.store');
    Route::get('all', 'OfferController@all')->name('ajax.offer.all');
    Route::post('delete', 'OfferController@delete')->name('ajax.offer.delete');
    Route::get('edit/{offer_id}', 'OfferController@edit')->name('ajax.offer.edit');
    Route::post('update', 'OfferController@update')->name('ajax.offer.update');
});
//////////////////////////End Ajax Routes////////////////////////////


/////////////////////Begain Authentication && Guards/////////////////////////
Route::group(['middleware' => 'checkAge', 'namespace' => 'Auth'], function () {
    Route::get('adualts','CustomAuthController@adualt')->name('adualt.index');
});

Route::get('site','Auth\CustomAuthController@site')->middleware('auth:web')->name('site.index');
Route::get('admin','Auth\CustomAuthController@admin')->middleware('auth:admin')->name('admin.index');

Route::get('admin/login', 'Auth\CustomAuthController@adminLogin')-> name('admin.login');
Route::post('admin/login', 'Auth\CustomAuthController@checkAdminLogin')-> name('save.admin.login');

/////////////////////End Authentication && Guards////////////////////////////


/////////////////////////////////////////Start Relations Routes///////////////////////////////////////////
Route::group(['namespace' => 'Relation'], function () {

    Route::get('has-one', 'RelationController@hasOneRelation');
    Route::get('has-one-reverse', 'RelationController@hasOneRelationReverse');
    Route::get('get-user-has-phone', 'RelationController@getUserHasPhone');
    Route::get('get-user-has-phone-with-condition', 'RelationController@getUserHasPhoneWithCondition');
    Route::get('get-user-has-no-phone', 'RelationController@getUserHasNotPhone');


    ///////////////////Start one to many Relationship////////////////////
    Route::get('hosp-has-many', 'RelationController@getHospDoctors');
    Route::get('hospitals', 'RelationController@hospitals')->name('hospital.all');
    Route::get('hospitals/{hospital_id}', 'RelationController@deleteHospital')->name('hospital.delete');
    Route::get('doctors/{hospital_id}', 'RelationController@doctors')->name('doctors');
    Route::get('hospitals-has-doctors', 'RelationController@hospitalsHasDoctors');
    Route::get('hospitals-has-doctors-male', 'RelationController@hospitalsHasMaleDoctors');
    Route::get('hospitals-has-no-doctors', 'RelationController@hospitalsHasNoDoctors');
    ///////////////////End one to many Relationship//////////////////////


    ///////////////////End many to many Relationship//////////////////////
    Route::get('doctors-services', 'RelationController@getDoctorServices');
    Route::get('services-doctors', 'RelationController@getServiceDoctors');
    Route::get('doctors/services/{doctor_id}', 'RelationController@getDoctorServiceByTd')->name('get.doctor.service');
    Route::post('save-services-to-doctor/', 'RelationController@saveServiceToDoctor')->name('save.doctors.services');
    ///////////////////End many to many Relationship//////////////////////


    ////////////////Start Has One Through Relationship/////////////////////
    Route::get('has-one-through','RelationController@getPatientDoctor');
    Route::get('has-many-through','RelationController@getCountryDoctor');
    //////////////////End Has One Through Relationship/////////////////////
});

/////////////////////////////////////////////////End Relations Routes ///////////////////////////////////////

//////////////////////////Start Accessors & Mutators ///////////////////////////////////
Route::get('get-doctors', 'Relation\RelationController@getDoctors');
//////////////////////////End Accessors & Mutators /////////////////////////////////////

/////////////////////////Start Collection ////////////////////////////
Route::get('collection', 'CollectTut@index');
Route::get('mainCategories', 'CollectTut@complex');
Route::get('main-categories', 'CollectTut@complexFilter');
Route::get('main-cats3', 'CollectTut@complexTransform');
/////////////////////////End Collection //////////////////////////////
