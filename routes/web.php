<?php

use App\Models\Sightengine;
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

Route::post('store','App\Http\Controllers\SightengineController@store')->name('file.upload.post');

Route::get('store',function () {
    return redirect()->to('/');
});
