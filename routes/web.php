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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/messenger/new', 'GroupController@createNewGroup')->name('createNewGroup');
Route::get('/messenger/new', 'GroupController@newGroup')->name('newGroup');
Route::get('/messenger/{group_id?}', 'GroupController@openGroup')->name('messenger');

Route::delete('/group/user/delete', 'GroupController@deleteUser')->name('deleteGroupUser');

Route::get('/invites', 'InviteController@index')->name('invites');
Route::get('/invites/accept/{id}', 'InviteController@accept')->name('acceptInvite');
Route::get('/invites/decline/{id}', 'InviteController@decline')->name('declineInvite');

//user routes
Route::get('/user', 'UserController@userDetailView')->name('userDetailView');
Route::get('/user/edit', 'UserController@editUserView')->name('editUserView');
Route::post('/user/update', 'UserController@updateUser')->name('updateUser');
Route::get('/users/all', 'APIController@allUsers');