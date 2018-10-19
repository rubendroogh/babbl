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

Route::middleware('auth:api')->group(function(){
	Route::get('/users/all', 'APIController@all_users');
	Route::get('/user/groups', 'APIController@all_user_groups');
	Route::get('/user', 'APIController@user');

	Route::get('/groups/all', 'APIController@all_groups');
	Route::get('/groups/{id}/messages', 'APIController@all_group_messages');
	Route::get('/groups/{id}/users', 'APIController@all_group_users');
});

Route::post('/message/send', 'APIController@send_message_init');
Route::post('/message/read', 'APIController@message_read');