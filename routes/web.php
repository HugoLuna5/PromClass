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
Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {

    Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

    Route::group(['prefix' => '/matters'], function () {
        Route::get('/', 'App\Http\Controllers\MatterController@index')->name('matters');
        Route::get('/create', 'App\Http\Controllers\MatterController@create')->name('createMatter');
        Route::post('/save', 'App\Http\Controllers\MatterController@save')->name('saveMatter');

        Route::group(['prefix' => '/show/{id}'], function () {
            Route::get('', 'App\Http\Controllers\MatterController@show')->name('showMatter');
            Route::get('/activity/create', 'App\Http\Controllers\ActivityController@add')->name('addActivity');
            Route::post('/activity/load', 'App\Http\Controllers\ActivityController@load')->name('loadActivities');
            Route::put('/units/show/{unit_id}', 'App\Http\Controllers\UnitController@show')->name('showUnit');

        });
        Route::group(['prefix' => '/units'], function () {
            Route::put('/update', 'App\Http\Controllers\UnitController@update')->name('updateUnit');


        });

    });

    Route::group(['prefix' => '/groups'], function () {
        Route::get('/', 'App\Http\Controllers\GroupController@index')->name('groups');
        Route::get('/show/{id}', 'App\Http\Controllers\GroupController@show')->name('showGroup');
        Route::get('/create', 'App\Http\Controllers\GroupController@create')->name('createGroup');
        Route::post('/save', 'App\Http\Controllers\GroupController@save')->name('saveGroup');
        Route::post('/update', 'App\Http\Controllers\GroupController@update')->name('updateGroup');

    });


    Route::group(['prefix' => '/periods'], function () {
        Route::get('/', 'App\Http\Controllers\PeriodController@index')->name('periods');
        Route::get('/show/{id}', 'App\Http\Controllers\PeriodController@show')->name('showPeriod');
        Route::get('/create', 'App\Http\Controllers\PeriodController@create')->name('createPeriod');
        Route::post('/save', 'App\Http\Controllers\PeriodController@save')->name('savePeriod');
        Route::post('/update', 'App\Http\Controllers\PeriodController@update')->name('updatePeriod');
        Route::get('/delete/{id}', 'App\Http\Controllers\PeriodController@delete')->name('deletePeriod');
    });


});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return redirect('/home');
})->name('dashboard');
