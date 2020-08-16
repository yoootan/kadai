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
    return view('welcome');
});
//お客様用
Route::get('/customer_index','CustomerController@customer_index');
Route::get('/customer_create','CustomerController@customer_create');
Route::post('/customer_store','CustomerController@customer_store');
Route::post('/customer_update','CustomerController@customer_update');
Route::get('/customer_finish','CustomerController@customer_finish');
Route::get('/customer_cancel','CustomerController@customer_cancel');
Route::post('/customer_cancel_store','CustomerController@customer_cancel_store');
Route::get('/customer_cancel_finish','CustomerController@customer_cancel_finish');

Route::get('/load-events', 'EventController@loadEvents')->name('routeLoadEvents');
Route::put('/event-update', 'EventController@update')->name('routeEventUpdate');
Route::post('/event-store', 'EventController@store')->name('routeEventStore');
Route::delete('/event-destroy', 'EventController@destroy')->name('routeEventDelete');
Route::get('/customer_test','CustomerController@customer_test');

Route::post('/customer-event-create', 'CustomerController@create')->name('routeCustomerEventCreate');
Route::post('/customer-event-store', 'CustomerController@store')->name('routeCustomerEventStore');
Route::put('/customer-event-update', 'CustomerController@update')->name('routeCustomerEventUpdate');

//管理者用
Route::group(['middleware' => ['auth']], function() {

Route::get('/admin_index','AdminController@admin_index');
Route::get('/admin_edit','AdminController@admin_edit');
Route::post('/admin_store','AdminController@admin_store');
Route::get('/admin_reserved_show/{start}','AdminController@admin_reserved_show');
Route::get('/admin_cancel_show/{start}','AdminController@admin_cancel_show');
Route::get('/admin_test','AdminController@admin_test');
Route::get('/admin_test2','AdminController@admin_test2');
Route::get('/admin_management','AdminController@admin_management');
Route::post('/admin_management_store','AdminController@admin_management_store');
Route::get('/admin_create_menu','AdminController@admin_create_menu');
Route::get('/admin_create_nailist','AdminController@admin_create_nailist');
Route::post('/admin_store_menu','AdminController@admin_store_menu');
Route::post('/admin_store_nailist','AdminController@admin_store_nailist');

    
});

//ajax
Route::get('ajax/menu', 'Ajax\AjaxAdminController@menu');
Route::get('ajax/nailist', 'Ajax\AjaxAdminController@nailist');







Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
