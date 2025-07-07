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
     Route::get('/ponto-de-coleta/{id}', [MainController::class, 'view'])->name('collection_point.view');

     Route::middleware(['verified'])->group(function () {
          Route::get('/ponto-de-coleta', [MainController::class, 'collectionPoint'])->name('collection_point.index');
          Route::get('/mapa', [MainController::class, 'map'])->name('map');
          Route::post('/ponto-de-coleta', [CollectionPointController::class, 'store'])->name('collection_point.store');
     });

     Route::get('/perfil/{id}', [MainController::class, 'profile'])->name('user.profile');
});

// USER ACTIONS
Route::prefix('user')->group(function(){
     Route::middleware(['auth'])->group(function () {
          Route::middleware(['verified', 'password.confirm'])->group(function () {
               Route::put('/{id}', [UserController::class, 'update'])->name('user.update');
               Route::delete('/{id}', [UserController::class, 'destroy'])->name('user.destroy');
          });
     });
});
