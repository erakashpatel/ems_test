<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportController;
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
Route::get('/import', 'App\Http\Controllers\ImportController@showImportForm')->name('import.form');
Route::post('/import', 'App\Http\Controllers\ImportController@import')->name('import.process');
Route::post('store','App\Http\Controllers\ImportController@store')->name('import.store');
