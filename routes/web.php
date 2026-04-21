<?php

use App\Http\Controllers\BondController;
use App\Http\Controllers\DrawController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/home', [BondController::class, 'index'])->name('home');
    Route::resource('bond', BondController::class);

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/', [BondController::class, 'index']);
    Route::post('/bonds', [BondController::class, 'store'])->name('bonds.store');
    Route::get('/bonds', [BondController::class, 'index'])->name('bonds.index');
    Route::resource('admin', DrawController::class);
});