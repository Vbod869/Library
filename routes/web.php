<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminBooksController;
use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;

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
// user
Route::get('/', [HomeController::class, 'index']);
Route::post('/', [HomeController::class, 'category']);
Route::resource('/books', BookController::class);
Route::resource('/booking', BookingController::class)->middleware('auth');

// admin and librarian
Route::get('/admin', [DashboardController::class, 'index'])->middleware('adminandlibrarian');
Route::resource('/admin/booking', AdminBookingController::class)->middleware('adminandlibrarian');

// admin only
Route::resource('/admin/books', AdminBooksController::class)->middleware('admin');

// login
Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');

// logout
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

// register
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');
