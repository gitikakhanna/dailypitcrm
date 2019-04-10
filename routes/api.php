<?php

use Illuminate\Http\Request;

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

Route::post('/subcategory-retrieve',function(Request $request){
	$subcategory_names = \App\subcategories::where('category_id', $request->id)->get();

	$local = array();
	foreach($subcategory_names as $s)
		$local[] = $s;
	return $local;
});