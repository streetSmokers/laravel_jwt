<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;

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

Route::get('/', [LoginController::class,'login']);
Route::get('/login',[LoginController::class,'login'])->name('login');
Route::post('/actionlogin',[LoginController::class,'ActionLogin'])->name('actionlogin');
Route::get('/actionlogout',[LoginController::class,'ActionLogout'])->name('actionlogout');
Route::get('/home',[HomeController::class,'home'])->name('home');
Route::get('/register',[RegisterUserController::class,'register'])->name('register');
Route::post('/actionregister',[RegisterUserController::class,'ActionRegister'])->name('actionregister');
