<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider within a group
| which contains the "web" middleware group. Now create something great!
|
*/

// 🔹 Redirect root URL to login page if not logged in
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

// 🔹 Authentication routes (login, register, password reset)
Auth::routes(['verify' => true]);

// 🔹 Authenticated user routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Default home route (if used)
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // CRM dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
