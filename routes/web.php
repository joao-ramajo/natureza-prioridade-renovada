<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CollectionPointController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
Route::get('/csv', [AdminController::class, 'exportCsv'])->name('csv-export');

Route::get('/', [MainController::class, 'index'])->name('home');
Route::redirect('/home', '/');
Route::get('/mapa', [MainController::class, 'map'])->name('map');
Route::get('/pontos', [MainController::class, 'pontos'])->name('pontos');

Route::prefix('me')->middleware(['auth'])->group(function () {
     Route::get('/', [MainController::class, 'profile'])->name('me.profile');
     Route::put('/', [UserController::class, 'update'])->name('me.update')->middleware(['verified']);
     Route::delete('/', [UserController::class, 'destroy'])->name('me.destroy')->middleware(['password.confirm']);
});
Route::prefix('ponto-de-coleta')->group(function () {
     Route::get('/', [MainController::class, 'collectionPoint'])->name('collection_point.index');
     Route::get('/{id}', [MainController::class, 'view'])->name('collection_point.view');
     Route::middleware(['auth', 'verified'])->group(function () {
          Route::post('/', [CollectionPointController::class, 'store'])->name('collection_point.store');
          Route::middleware(['password.confirm'])->group(function () {
               Route::put('/{id}', [CollectionPointController::class, 'update'])->name('collection_point.update');
               Route::delete('/{id}', [CollectionPointController::class, 'destroy'])->name('collection_point.destroy');
          });
     });
});
