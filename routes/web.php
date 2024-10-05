<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard',[AccountController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/add',[AccountController::class,'store']);
    Route::get('/edit/{id}',[AccountController::class,'show_edit']);
    Route::post('/update/{id}',[AccountController::class,'update']);
    Route::delete('/delete/{id}',[AccountController::class,'delete']);

    Route::get('/create-user',[AccountController::class,'create_user'])->name('create-user');
    Route::post('/create-user',[AccountController::class,'store_user']);
    Route::delete('/delete/{id}/user',[AccountController::class,'delete_user']);
});

require __DIR__.'/auth.php';
