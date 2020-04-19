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

Route::group(['middleware' => ['auth']], function () {
    // Redirect to the user page
    Route::get('/profile', function () {
        return response()->redirectToRoute('users.show', [Auth::id()]);
    })->name('profile');

    Route::group(['namespace' => 'User'], function () {
        Route::resource('users', 'UserController');
        Route::resource('users.tasks', 'TaskController');
    });

    Route::group(['namespace' => 'Resident'], function () {
        Route::resource('residents', 'ResidentController');
        Route::resource('residents.doctor_appointment', 'DoctorAppointmentController');
        Route::resource('residents.parents', 'ParentController');
        Route::resource('residents.punishments', 'PunishmentController');
        Route::resource('residents.responsibilities', 'ResponsibilityController');
        Route::resource('residents.tasks', 'TaskController');
        Route::resource('residents.notes', 'NoteController');
    });

    Route::group(['namespace' => 'Parent'], function () {
        Route::resource('parents.notes', 'NoteController');
    });

    Route::resource('fines', 'FineController');
    Route::resource('tasks', 'TaskController');
    Route::resource('reports', 'ReportController');
    Route::resource('rules', 'RuleController');
    Route::resource('responsibilities', 'ResponsibilityController');
    Route::resource('punishments', 'PunishmentController');
    Route::resource('notes', 'NoteController');
    Route::resource('archive', 'ArchiveController');
    Route::resource('parents', 'ParentController');
});
