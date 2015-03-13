<?php
Route::get('/', function(){
    return View::make('admin.views.index');
});

 Route::get('/test/login/{id}', function($id){
 	Auth::user()->logout();
 	Auth::user()->loginUsingId($id);

 });

 Route::get('/test/logout', function(){
 	Auth::user()->logout();
 });




Route::group(['before' => ''], function(){

	Route::resource('spider', 'MainController');

});



Route::controller('auth', 'WechatAuthController');


Route::group(['prefix' => 'admin'], function(){

	Route::get('login', ['as' => 'admin.login', 'uses' => 'AdminSessionController@create']);
	Route::get('logout', ['as' => 'admin.logout', 'uses' => 'AdminSessionController@destroy']);
	Route::post('login', ['as' => 'admin.auth', 'uses' => 'AdminSessionController@store']);

	Route::group(['before' => 'auth.admin'], function(){

		Route::resource('account', 'AdminAccountController');

		Route::get('/', ['as' => 'admin.dashboard', 'uses' => 'AdminController@index']);

	});


});
Route::controller('/admin', 'AdminController');
