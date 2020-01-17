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


/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'IndexController@home')->name('home');
Route::resource('/user','UserController');

Route::get('loginout','LoginController@logout')->name('loginout');
Route::get('login','LoginController@login')->name('login');
Route::post('login','LoginController@store')->name('login');

Route::get('comfirmEmail/{token}','UserController@comfirmEmail')->name('comfirmEmail');


//找回密码路由
Route::get('FindPassWordEmail','PassWordController@email')->name('FindPassWordEmail');
Route::post('FindPassWordSend','PassWordController@send')->name('FindPassWordSend');
Route::get('FindPassWordEdit/{token}','PassWordController@edit')->name('FindPassWordEdit');
Route::post('FindPassWordUpdate','PassWordController@update')->name('FindPassWordUpdate');

//博客的资源路由
Route::resource('blog','BlogController');

//关注去管
Route::get('follow/{user}','UserController@follow')->name('user.follow');

Route::get('follower/{user}','FollowController@follow')->name('follower');
Route::get('following/{user}','FollowController@following')->name('following');
