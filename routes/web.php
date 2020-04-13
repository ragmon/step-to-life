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

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
// Redirect to the user page
Route::get('/profile', function () {
    return response()->redirectToRoute('users.show', [Auth::id()]);
})->name('profile');

Route::resource('users', 'UserController');
Route::resource('fines', 'FineController');
Route::resource('residents', 'ResidentController');
Route::resource('tasks', 'TaskController');
