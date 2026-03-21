<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes — Sahayog Foundation
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/programs', function () {
    return view('pages.programs');
})->name('programs');

Route::get('/donate', function () {
    return view('pages.donate');
})->name('donate');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');
