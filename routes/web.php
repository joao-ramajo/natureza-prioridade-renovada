<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/notes', function () {
     return view('notes');
})->name('notes');


Route::middleware(['auth'])->group(function () {
     Route::get('/', [MainController::class, 'index'])->name('home');
     Route::get('/home', [MainController::class, 'index'])->name('home');
});
