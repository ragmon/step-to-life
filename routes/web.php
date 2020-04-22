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

Route::get('/home', function () {
    return response()->redirectToRoute('history.index');
})->name('home');

Route::group(['middleware' => ['auth']], function () {
    // Redirect to the user page
    Route::get('/profile', function () {
        return response()->redirectToRoute('users.show', [Auth::id()]);
    })->name('profile');

    Route::group(['namespace' => 'User'], function () {
        Route::resource('users', 'UserController')->except(['create', 'edit']);
        Route::resource('users.tasks', 'TaskController')->only(['update', 'destroy']);
    });

    Route::group(['namespace' => 'Resident'], function () {
        Route::resource('residents', 'ResidentController')->except(['edit', 'update']);
        Route::resource('residents.doctor_appointment', 'DoctorAppointmentController')->except(['index', 'create', 'edit']);
        Route::resource('residents.parents', 'ParentController')->only(['store']);
        Route::resource('residents.punishments', 'PunishmentController')->except(['index', 'create', 'edit']);
        Route::resource('residents.responsibilities', 'ResponsibilityController')->only(['index', 'store']);
        Route::resource('residents.tasks', 'TaskController')->only(['update', 'destroy']);
        Route::resource('residents.notes', 'NoteController')->only(['store', 'destroy']);
    });

    Route::group(['namespace' => 'Parent'], function () {
        Route::resource('parents.notes', 'NoteController')->only(['store', 'destroy']);
    });

    Route::resource('fines', 'FineController')->except(['index', 'create', 'edit']);
    Route::resource('tasks', 'TaskController')->except(['create', 'edit']);
    Route::resource('reports', 'ReportController');
    Route::resource('rules', 'RuleController');
    Route::resource('responsibilities', 'ResponsibilityController')->except(['create', 'edit']);
    Route::resource('punishments', 'PunishmentController')->only(['index']);
    Route::resource('notes', 'NoteController')->only(['index', 'destroy']);
    Route::resource('archive', 'ArchiveController')->only(['index', 'show', 'update']);
    Route::resource('parents', 'ParentController')->except(['create', 'store', 'edit']);
    Route::resource('history', 'HistoryController')->only(['index']);
});
