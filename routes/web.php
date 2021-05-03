<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AdoptionController;


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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('animals',AnimalController::class);
//Route::get('display',' App\Http\Controllers\AnimalController@display')
//->name('display_account');
Route::resource('adoptions', AdoptionController::class);
//Route::post('','AdoptionController@store')->name('adoptions.store');
Route::get('acceptView', [App\Http\Controllers\AdoptionController::class, 'acceptView'])->name('acceptView');
Route::get('myAdoptions', [App\Http\Controllers\AdoptionController::class, 'myAdoptions'])->name('myAdoptions');
