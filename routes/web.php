<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['auth', 'verified']], function () {
	Route::group(['prefix' => 'employee'], function () {
		$ctr = 'EmployeeController';
		Route::get('add', $ctr . '@add')->name('employee.add');
		Route::get('addSuccess', $ctr . '@addSuccess')->name('employee.addSuccess');
		Route::get('editSuccess', $ctr . '@editSuccess')->name('employee.editSuccess');
		Route::post('create', $ctr . '@create')->name('employee.create');
		Route::get('{id}/edit', $ctr . '@edit')->name('employee.edit');
		Route::put('{id}/edit', $ctr . '@update')->name('employee.update');
		Route::get('{id}/destroy', $ctr . '@delete')->name('employee.delete');
	});
});
