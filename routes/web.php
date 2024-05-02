<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRegistrationController;
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
Route::get('user-registration', [UserRegistrationController::class, 'index'])->name('userRegister');
Route::get('logout', [LoginController::class, 'logout']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/employee-dashboard', [HomeController::class, 'employeeDashboard'])->name('employeeDashboard');


Route::middleware('auth')->group(function () {
    //Admin route starte
    Route::group(['prefix' => 'admin'], function () {
        Route::resource('roles', RoleController::class);
        Route::post('approves/{id}', [UserController::class, 'approve'])->name('approve');
        Route::post('blocks/{id}', [UserController::class, 'block'])->name('block');
        Route::resource('users', UserController::class);
    });
    //Admin route end 

    //Leave route start
    Route::group(['prefix' => 'leave'], function () {
        Route::get('leave/{id}', [LeaveController::class, 'show'])->name('leaveDetails');
        Route::post('leave-approve-request/{id}', [LeaveController::class, 'leaveApproveReject'])->name('leaveApproveReject');
        Route::resource('leaves', LeaveController::class);
    });
    //Leave route end
});
