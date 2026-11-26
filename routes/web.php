<?php

use App\Http\Controllers\SiteController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\BetaTesterController;
use App\Http\Middleware\TrackVisit;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\FilterController;

Route::get('/', [SiteController::class, 'index'])->name('home');
Route::get('/say/{message?}', [SiteController::class, 'say'])->name('site.say');
Route::get('/entry', [SiteController::class, 'entry'])->name('entry.form');
Route::post('/entry', [SiteController::class, 'entryStore'])->name('entry.store');
Route::view('/about', 'site.about')->name('site.about');
Route::view('/contact', 'site.contact')->name('site.contact');
Route::get('/landing', [SiteController::class, 'landing'])->name('landing');
Route::post('/landing', [SiteController::class, 'landingStore'])->name('landing.store');

// Публічний перелік блогу
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');

// --- ЗАХИЩЕНІ МАРШРУТИ (тільки для авторизованих) ---
Route::middleware('auth')->group(function () {

    // Особистий кабінет (Dashboard)
    Route::get('/dashboard', function () {
        $blogs = auth()->user()->blogs()->orderByDesc('dt_created')->get();
        return view('dashboard', compact('blogs'));
    })->name('dashboard');

    // Адміністрування блогу
    // ВАЖЛИВО: специфічні маршрути (admin, create, edit) мають бути ДО динамічного {blog}
    Route::get('/blog/admin', [BlogController::class, 'admin'])->name('blog.admin');
    Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create');
    Route::post('/blog', [BlogController::class, 'store'])->name('blog.store');
    Route::get('/blog/{blog}/edit', [BlogController::class, 'edit'])->name('blog.edit');
    Route::put('/blog/{blog}', [BlogController::class, 'update'])->name('blog.update');
    Route::delete('/blog/{blog}', [BlogController::class, 'destroy'])->name('blog.destroy');
    Route::get('/blog/{blog}/tags', [BlogController::class, 'tags'])->name('blog.tags');
    Route::post('/blog/{blog}/tags', [BlogController::class, 'tagsStore'])->name('blog.tags.store');

    // Бета-тестувальники
    Route::resource('beta-testers', BetaTesterController::class);

    // Довідник міток
    Route::resource('filters', FilterController::class)->except(['show']);

    // Статистика
    Route::get('/stats', [StatsController::class, 'pages'])->name('stats.pages');
    Route::get('/stats/detail', [StatsController::class, 'detail'])->name('stats.detail');
});

// --- ДИНАМІЧНІ ПУБЛІЧНІ МАРШРУТИ (мають бути в САМОМУ КІНЦІ) ---
// Цей маршрут ловить все, що йде після /blog/, тому він має бути останнім
Route::get('/blog/{blog}', [BlogController::class, 'show'])->name('blog.show');

// Підключення маршрутів Breeze
require __DIR__ . '/auth.php';
