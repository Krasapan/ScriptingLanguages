<?php

use App\Http\Controllers\SiteController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\BetaTesterController;
use App\Http\Middleware\TrackVisit;
use App\Http\Controllers\StatsController;

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

Route::resource('country',
    CountryController::class
);

Route::resource('beta-testers',
    BetaTesterController::class
);

Route::get('/stats',
    [StatsController::class, 'pages']
)->name('stats.pages');

Route::get('/stats/detail',
    [StatsController::class, 'detail']
)->name('stats.detail');
