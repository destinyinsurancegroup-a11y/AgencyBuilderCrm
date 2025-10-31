<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/book', function () {
    return view('book');
});

Route::get('/contacts', function () {
    return view('contacts');
});

Route::get('/agents', function () {
    return view('agents');
});

Route::get('/calendar', function () {
    return view('calendar');
});

Route::get('/settings', function () {
    return view('settings');
});

Route::get('/logout', function () {
    return redirect('/');
});
