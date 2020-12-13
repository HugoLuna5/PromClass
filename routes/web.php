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
    return redirect('/login');
});
Route::group(['middleware' => ['auth:sanctum', 'verified']], function (){

    Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

    Route::prefix('/matters', function (){

        Route::get('', 'App\Http\Controllers\MatterController@index')->name('matters');
        Route::get('/{id}', 'App\Http\Controllers\MatterController@show')->name('showMatter');

        Route::get('/create', 'App\Http\Controllers\MatterController@create')->name('createMatter');


    });

        Route::get('/periods', 'App\Http\Controllers\PeriodController@index')->name('periods');
        Route::get('/periods/show/{id}', 'App\Http\Controllers\PeriodController@show')->name('showPeriod');
        Route::get('/periods/create', 'App\Http\Controllers\PeriodController@create')->name('createPeriod');
        Route::post('/periods/save', 'App\Http\Controllers\PeriodController@save')->name('savePeriod');
        Route::post('/periods/update', 'App\Http\Controllers\PeriodController@update')->name('updatePeriod');
        Route::get('/periods/delete/{id}', 'App\Http\Controllers\PeriodController@delete')->name('deletePeriod');



});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return redirect('/home');
})->name('dashboard');
