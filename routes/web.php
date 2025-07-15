<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CollectionPointController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/', [MainController::class, 'index'])->name('home');
Route::redirect('/home', '/');
Route::get('/ponto-de-coleta/{id}', [MainController::class, 'view'])->name('collection_point.view');
Route::get('/mapa', [MainController::class, 'map'])->name('map');


Route::get('/csv', [AdminController::class, 'exportCsv'])->name('csv-export');

Route::middleware(['auth'])->group(function () {
     Route::get('/perfil/{id}', [MainController::class, 'profile'])->name('user.profile');

     Route::middleware(['verified'])->group(function () {
          Route::get('/ponto-de-coleta', [MainController::class, 'collectionPoint'])->name('collection_point.index');
          Route::post('/ponto-de-coleta', [CollectionPointController::class, 'store'])->name('collection_point.store');
     });
});

Route::middleware(['auth', 'verified', 'password.confirm'])->group(function () {
     Route::prefix('user')->group(function () {
          Route::put('/{id}', [UserController::class, 'update'])->name('user.update');
          Route::delete('/{id}', [UserController::class, 'destroy'])->name('user.destroy');
     });
     Route::prefix('ponto-de-coleta')->group(function () {
          Route::put('/{id}', [CollectionPointController::class, 'update'])->name('collection_point.update');
          Route::delete('/{id}', [CollectionPointController::class, 'destroy'])->name('collection_point.destroy');
     });
});
