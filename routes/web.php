<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\UI\PagesController::class, 'index'])->name('home');
Route::get('/where-am-i', [App\Http\Controllers\UI\PagesController::class, 'contact'])->name('contact');
Route::get('/get-in-touch', [App\Http\Controllers\UI\PagesController::class, 'getInTouch'])->name('getInTouch');
Route::get('/practice/{page?}', [App\Http\Controllers\UI\PagesController::class, 'practice'])->name('practice');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';

Route::get('/{any}', [App\Http\Controllers\UI\PagesController::class, 'page']);
