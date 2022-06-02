<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['namespace' => 'Api', 'middleware' => 'basicAuth'], function() {
    Route::post('execute', 'SqlController@execute')->name('execute');
});
