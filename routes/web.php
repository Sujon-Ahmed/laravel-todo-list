<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
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

Route::post('/task/create', [TaskController::class, 'create']);
Route::get('/status/change/{id}', [TaskController::class, 'status']);
Route::get('/task/delete/{id}', [TaskController::class, 'delete']);

Route::get('login/google', 'App\Http\Controllers\Auth\LoginController@redirectToGoogle')->name('google.login');
Route::get('login/google/callback', 'App\Http\Controllers\Auth\LoginController@handleGoogleCallback');