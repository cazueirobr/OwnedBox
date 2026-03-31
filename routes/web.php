<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tela1', function(){
    return view ('register');
});

Route::get('/tela2', function(){
    return view ('login');
});

Route::get('/tela3', function(){
    return view ('menu');
});

Route::get('/tela4', function(){
    return view ('sql');
});

Route::get('/tela5', function(){
    return view ('perfil');
});