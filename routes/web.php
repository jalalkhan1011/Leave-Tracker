<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\Auth\LoginController; 
use App\Http\Controllers\RoleController; 
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('logout', [LoginController::class, 'logout']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware('auth')->group(function () {
    //Admin routte starte
    Route::group(['prefix' => 'admin'], function () {
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
    });
    //Admin routte end 
});
