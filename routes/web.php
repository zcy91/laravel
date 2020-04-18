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

Route::get('/user/{id}', function ($id) {
    return "用户ID: " . $id;
});

Route::get('/task','TaskController@home');
Route::get('task/create', 'TaskController@create');
Route::post('task', 'TaskController@store');
Route::resource('post', 'PostController');
// 用于显式上传表单
Route::get('form/image', 'RequestController@formPage');
// 用于处理文件上传
Route::post('form/file_upload', 'RequestController@fileUpload');
Route::get('formIndex', 'RequestController@index')->name('form.index');
Route::post('form', 'RequestController@form')->name('form.submit');

