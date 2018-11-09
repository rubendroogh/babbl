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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::post('/messenger/new', 'GroupController@create')->name('createNewGroup');
Route::get('/messenger/new', 'GroupController@create_form_view')->name('newGroup');
Route::get('/messenger/{group_id?}', 'GroupController@read')->name('messenger');

Route::delete('/group/user/delete', 'GroupController@delete_user')->name('deleteGroupUser');

Route::get('/invites', 'InviteController@index')->name('invites');
Route::get('/invites/accept/{id}', 'InviteController@accept')->name('acceptInvite');
Route::get('/invites/decline/{id}', 'InviteController@decline')->name('declineInvite');

//user routes
Route::get('/user', 'UserController@read_form_view')->name('userDetailView');
Route::get('/user/edit', 'UserController@edit_form_view')->name('editUserView');
Route::post('/user/update', 'UserController@update')->name('updateUser');
Route::get('/users/all', 'APIController@all_users');

// Temporary api route
Route::get('/user/groups', 'APIController@all_user_groups');