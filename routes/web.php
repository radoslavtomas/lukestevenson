<?php

use App\Http\Controllers\UI\PagesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PagesController::class, 'index'])->name('home');
Route::get('/where-am-i', [PagesController::class, 'contact'])->name('contact');
Route::get('/get-in-touch', [PagesController::class, 'getInTouch'])->name('getInTouch');
Route::get('/practice/{page?}', [PagesController::class, 'practice'])->name('practice');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';

Route::get('/{any}', [PagesController::class, 'page']);
