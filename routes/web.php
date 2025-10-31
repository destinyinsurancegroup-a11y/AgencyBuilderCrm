<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| These routes load the ContactController and set the home redirect.
| This ensures / and /contacts both work properly on DigitalOcean.
|
*/

Route::get('/', function () {
    return redirect()->route('contacts.index');
});

Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
Route::get('/contacts/find', [ContactController::class, 'find'])->name('contacts.find');
