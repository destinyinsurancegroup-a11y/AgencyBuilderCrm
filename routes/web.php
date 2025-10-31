<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return redirect('/contacts');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/find', [ContactController::class, 'find'])->name('contacts.find');
});
