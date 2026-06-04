<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')
    ->name('home');

Route::view('/login', 'auth.login')
    ->middleware('guest')
    ->name('login');

Route::view('/register', 'auth.register')
    ->middleware('guest')
    ->name('register');

Route::post('/logout', fn() => redirect('/'))
    ->middleware('auth')
    ->name('logout');