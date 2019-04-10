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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/category', 'CategoryController@index');
Route::post('/category/add', 'CategoryController@store');

Route::post('/subcategory/add', 'SubcategoriesController@store');

Route::get('/services', 'ServicesController@index');
Route::post('/services/add', 'ServicesController@store');