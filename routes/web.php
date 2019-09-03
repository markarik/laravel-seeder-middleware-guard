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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/admin','AdminController@index')->name('admin.home');
Route::get('/admins','AuthAdmin\RegisterController@send')->name('admin.send');
Route::get('/admin/login','AuthAdmin\LoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login/submit','AuthAdmin\LoginController@login')->name('admin.login.submit');
Route::get('/admin/register','AuthAdmin\RegisterController@index')->name('admin.register');
Route::get('admin/dashboard','AdminController@create')->name('admin.dashboard');


Route::post('/admin/register','AuthAdmin\RegisterController@store')->name('admin.register.store');



