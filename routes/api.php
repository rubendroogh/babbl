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

Route::get('/users/all', 'APIController@allUsers');
Route::get('/users/{id}/groups', 'APIController@allUserGroups');

Route::get('/groups/all', 'APIController@allGroups');
Route::get('/groups/{id}/messages', 'APIController@allGroupMessages');
Route::get('/groups/{id}/users', 'APIController@allGroupUsers');

Route::post('/message/send', 'MessageController@sendMessage');
Route::post('/message/read', 'MessageController@messageRead');