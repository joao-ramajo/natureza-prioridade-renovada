<?php

use App\Http\Controllers\CollectionPointController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/notes', function () {
     return view('notes');
})->name('notes');


Route::get('/', function () {
     try {
          DB::connection()->getPdo();
          return redirect()
               ->route('login');
     } catch (Exception $e) {
          return view('errors.db-down');
     }
});



Route::middleware(['auth'])->group(function () {




     Route::middleware(['verified'])->group(function () {
          Route::get('/ponto-de-coleta', [MainController::class, 'collectionPoint'])->name('collection_point.index');

          Route::post('/ponto-de-coleta', [CollectionPointController::class, 'store'])->name('collection_point.store');
     });

     Route::get('/perfil/{id}', [MainController::class, 'profile'])->name('user.profile');
});

// USER ACTIONS
Route::prefix('user')->group(function () {
     Route::middleware(['auth', 'verified', 'password.confirm'])->group(function () {
          Route::put('/{id}', [UserController::class, 'update'])->name('user.update');

          Route::delete('/{id}', [UserController::class, 'destroy'])->name('user.destroy');
     });
});

Route::prefix('ponto-de-coleta')->group(function () {
     Route::middleware(['auth', 'verified, password.confirm'])->group(function () {
          Route::put('/{id}', [CollectionPointController::class, 'update'])->name('collection_point.update');
          Route::delete('/{id}', [CollectionPointController::class, 'destroy'])->name('collection_point.destroy');
     });
});

// ROTAS PÚBLICAS
Route::get('/home', [MainController::class, 'index'])->name('home');
Route::redirect('/', '/home');
Route::get('/ponto-de-coleta/{id}', [MainController::class, 'view'])->name('collection_point.view');
Route::get('/mapa', [MainController::class, 'map'])->name('map');
