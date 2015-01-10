<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});
//

// Confide RESTful route
Route::get('users/confirm/{code}', 'UsersController@getConfirm');
Route::get('users/reset_password/{token}', 'UsersController@getReset');
Route::get('users/reset_password', 'UsersController@postReset');
Route::controller( 'users', 'UsersController');


// Admin
Route::group(array('prefix'=>'admin', 'before'=> ''), function()
{
	// Admin Home
	Route::get('/', array('as'=>'admin', 'before'=>'auth', 'uses'=>function(){return View::make('base/admin');}));

	// Manage Users
	Route::resource('users', 'ManageUsersController');

	// Manage Roles
	Route::get('roles', array('as'=>'roles.list', 'uses'=>'ManageRolesController@index'));
	Route::get('manage/roles', 'ManageRolesController@rapyd');
	Route::post('manage/roles', 'ManageRolesController@rapyd');
	Route::patch('manage/roles', 'ManageRolesController@rapyd');
	Route::delete('manage/roles', 'ManageRolesController@rapyd');

	// Manage Permissions
	Route::get('permissions', array('as'=>'permissions.list', 'uses'=>'ManagePermissionsController@index'));
	Route::get('manage/permissions', 'ManagePermissionsController@rapyd');
	Route::post('manage/permissions', 'ManagePermissionsController@rapyd');
	Route::patch('manage/permissions', 'ManagePermissionsController@rapyd');
	Route::delete('manage/permissions', 'ManagePermissionsController@rapyd');

});

// App's routes
Route::get('login', 'UsersController@getLogin');