<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/home', function(){
     return view('home');
})->middleware(['auth']);

Route::get('/', function(){
     return view('home');
});