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

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'SandboxController@index');

    Route::get('/home', ['as' => 'home', 'uses' => 'SandboxController@index']);

    Route::get('/errors/warning/{message?}', ['as' => 'errors.warning', 'uses' => 'ErrorController@warning']);

    require_once "web-routes/web-route-getter.php";
});

/* Comment after deployment! */
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

