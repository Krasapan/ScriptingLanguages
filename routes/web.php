<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/',
    [SiteController::class, 'index']
)->name('home');

Route::get(
    '/say/{message?}',
    [SiteController::class, 'say']
)->name('site.say');

Route::get('/entry',
    [SiteController::class, 'entry']
)->name('entry.form');

Route::post('/entry',
    [SiteController::class, 'entryStore']
)->name('entry.store');

Route::view('/about', 'site.about'
)->name('site.about');

Route::view('/contact', 'site.contact'
)->name('site.contact');

Route::get('/landing',
    [SiteController::class, 'landing']
)->name('landing');

Route::post('/landing',
    [SiteController::class, 'landingStore']
)->name('landing.store');
