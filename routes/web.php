<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('dashboard'))->name('dashboard');
Route::get('/book', fn() => view('book'))->name('book');
Route::get('/contacts', fn() => view('contacts'))->name('contacts');
Route::get('/agents', fn() => view('agents'))->name('agents');
Route::get('/calendar', fn() => view('calendar'))->name('calendar');
Route::get('/settings', fn() => view('settings'))->name('settings');

Route::get('/logout', function () {
    return redirect()->route('dashboard');
})->name('logout');
