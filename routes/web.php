<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('menu');
    }
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::view('/menu', 'menu')->name('menu');
    Route::view('/sql', 'sql')->name('sql');
    Route::get('/perfil', function () {
        return view('perfil', ['user' => auth()->user()]);
    })->name('perfil');
    Route::get('/perfil/editar', [App\Http\Controllers\UserController::class, 'edit'])->name('perfil.edit');
    Route::post('/perfil/editar', [App\Http\Controllers\UserController::class, 'update'])->name('perfil.update');

        Route::resource('users', UserController::class);
});