<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    // Redirect to contacts page as the default
    return redirect('/contacts');
});

// Contact routes (no login required yet — we’ll add middleware later)
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
Route::get('/contacts/find', [ContactController::class, 'find'])->name('contacts.find');
