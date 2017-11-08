<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::post('/login/social', 'Auth\LoginController@loginSocial');
Route::get('/login/callback', 'Auth\LoginController@loginCallback');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function(){
	$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
	$this->post('login', 'Auth\LoginController@login');
	$this->post('logout', 'Auth\LoginController@logout')->name('logout');

	$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
	$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
	$this->get('password/reset/{token}', 'Auth\ForgotPasswordController@showResetForm')->name('password.reset');
	$this->post('password/reset', 'Auth\ResetPasswordController@reset');

	Route::group(['middleware' => 'can:admin'], function(){
		Route::get('/home', 'HomeController@index')->name('home');
	});

});

// Route::group(['middleware' => 'auth'], function(){
//     Route::get('/test', function(){
//         echo "Olá Mundo!";
//     });
// });

Route::group(['middleware' => 'guest'], function(){
    Route::get('/test', function(){
        echo "Olá Mundo!";
    });
});
