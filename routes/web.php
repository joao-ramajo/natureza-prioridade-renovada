<?php

use App\Http\Controllers\CollectionPointController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
use App\Models\CollectionPoint;
use Illuminate\Support\Facades\Route;

Route::get('/notes', function () {
     return view('notes');
})->name('notes');


Route::middleware(['auth'])->group(function () {
     Route::get('/', [MainController::class, 'index'])->name('home');
     Route::get('/home', [MainController::class, 'index'])->name('home');
     Route::get('/ponto-de-coleta', [MainController::class, 'collectionPoint'])->name('collection_point.index');
     Route::post('/ponto-de-coleta', [CollectionPointController::class, 'store'])->name('collection_point.store');
});
