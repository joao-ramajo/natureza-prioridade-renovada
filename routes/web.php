<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function() {
     Route::get('/', [MainController::class, 'index'])->name('home');
     Route::get('/home', [MainController::class, 'index'])->name('home');
});