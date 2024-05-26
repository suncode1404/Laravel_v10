<?php

use App\Http\Controllers\Ajax\LocationController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Middleware\AuthenticateMiddleware;
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

// BACKEND ROUTES
Route::get('dashboard/index', [DashboardController::class,'index'])->name('dashboard.index')->middleware(AuthenticateMiddleware::class);

//USER

Route::group(['prefix' => 'user'],function() {
    Route::get('index', [UserController::class,'index'])->name('user.index')->middleware('admin');
    Route::get('create', [UserController::class,'create'])->name('user.create')->middleware('admin');
    Route::post('store', [UserController::class,'store'])->name('user.store')->middleware('admin');
    Route::get('{id}/edit', [UserController::class,'edit'])->name('user.edit')->where(['id' => '[0-9]+'])->middleware('admin');
    Route::post('{id}/update', [UserController::class,'update'])->name('user.update')->where(['id' => '[0-9]+'])->middleware('admin');
    Route::get('{id}/delete', [UserController::class,'delete'])->name('user.delete')->where(['id' => '[0-9]+'])->middleware('admin');
    Route::delete('{id}/destroy', [UserController::class,'destroy'])->name('user.destroy')->where(['id' => '[0-9]+'])->middleware('admin');
});
        
//AJAX
Route::get('ajax/location/getLocation',[LocationController::class,'getLocation'])->name('ajax.location.index')->middleware('admin');

Route::get('login', [AuthController::class,'index'])->name('auth.login')->middleware('login');
Route::get('logout', [AuthController::class,'logout'])->name('auth.logout');
Route::post('login', [AuthController::class,'login'])->name('auth.dologin');


