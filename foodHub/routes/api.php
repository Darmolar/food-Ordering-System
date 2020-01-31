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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::get('/getFoods', 'PostController@getFoods');
Route::get('/getOrders', 'PostController@getOrders');
Route::post('/loginUser', 'PostController@loginUser');
Route::post('/orderFood', 'PostController@orderFood');
Route::post('/addUser', 'PostController@store');
Route::post('/addFood', 'PostController@storeFood');