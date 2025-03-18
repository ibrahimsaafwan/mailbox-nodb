<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contacts', [ContactController::class, 'showForm'])->name('contact.form');
Route::post('/contacts', [ContactController::class, 'submitForm'])->name('contact.submit');
