<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('dashboard'));
Route::get('/contacts', fn() => view('contacts'));
Route::get('/book', fn() => view('book'));
Route::get('/leads', fn() => view('leads'));
Route::get('/service', fn() => view('service'));
Route::get('/calendar', fn() => view('calendar'));
Route::get('/activity', fn() => view('activity'));
Route::get('/billing', fn() => view('billing'));
Route::get('/settings', fn() => view('settings'));
Route::get('/logout', fn() => view('welcome'));
