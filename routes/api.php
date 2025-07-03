<?php

use App\Http\Controllers\CollectionPointController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::post('/', [UserController::class, 'store'])->name('users.store');
    Route::get('/{id}', [UserController::class, 'show'])->name('users.show');
    Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});

Route::prefix('collection-point')->group(function() {
    Route::get('/', [CollectionPointController::class, 'index'])->name('collection_points.index');
    Route::post('/', [CollectionPointController::class, 'store'])->name('collection_points.store');
    Route::get('/{id}', [CollectionPointController::class, 'show'])->name('collection_points.show');
});