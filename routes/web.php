<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Auth;

// --------------------
// AUTH PROTECTION
// --------------------
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // All Contacts
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');

    // Book of Business
    Route::get('/book', [BookController::class, 'index'])->name('book');

    // Service Department
    Route::get('/service', [ServiceController::class, 'index'])->name('service');

    // Service Archive
    Route::get('/archive', [ArchiveController::class, 'index'])->name('archive');

    // Calendar
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');

    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');

    // Logout
    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/login');
    })->name('logout');
});

// --------------------
// PUBLIC / AUTH ROUTES
// --------------------
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout.perform');
