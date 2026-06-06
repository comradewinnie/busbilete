<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\TicketController as AdminTicketController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;

// Start page

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

// Trip search

Route::get('/trips', [TripController::class, 'index'])
    ->name('trips.index');

Route::get('/trips/{trip}', [TripController::class, 'show'])
    ->name('trips.show');

// Auth

Route::view('/login', 'auth.login')
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->middleware('guest');

Route::view('/register', 'auth.register')
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->middleware('guest');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// User: profile

Route::get('/profile', [ProfileController::class, 'show'])
    ->middleware('auth')
    ->name('profile.show');

Route::get('/profile/edit', [ProfileController::class, 'edit'])
    ->middleware('auth')
    ->name('profile.edit');

Route::patch('/profile', [ProfileController::class, 'update'])
    ->middleware('auth')
    ->name('profile.update');

Route::delete('/profile', [ProfileController::class, 'destroy'])
    ->middleware('auth')
    ->name('profile.destroy');

// User: tickets

Route::get('/tickets', [TicketController::class, 'index'])
    ->middleware('auth')
    ->name('tickets.index');

Route::get('/tickets/{ticket}', [TicketController::class, 'show'])
    ->middleware('auth')
    ->name('tickets.show');

// Admin: dashboard

Route::view('/admin', 'admin.dashboard')
    ->middleware('admin')
    ->name('admin.dashboard');

// Admin: user management

Route::get('/admin/users', [AdminUserController::class, 'index'])
    ->middleware('admin')
    ->name('admin.users.index');

Route::get('/admin/users/{user}', [AdminUserController::class, 'show'])
    ->middleware('admin')
    ->name('admin.users.show');

Route::delete('/admin/users/{user}', [AdminUserController::class, 'destroy'])
    ->middleware('admin')
    ->name('admin.users.destroy');

Route::patch('/admin/users/{user}/restore', [AdminUserController::class, 'restore'])
    ->middleware('admin')
    ->name('admin.users.restore');

// Admin: ticket management

Route::get('/admin/tickets', [AdminTicketController::class, 'index'])
    ->middleware('admin')
    ->name('admin.tickets.index');

Route::get('/admin/tickets/{ticket}', [AdminTicketController::class, 'show'])
    ->middleware('admin')
    ->name('admin.tickets.show');

Route::delete('/admin/tickets/{ticket}', [AdminTicketController::class, 'destroy'])
    ->middleware('admin')
    ->name('admin.tickets.destroy');

Route::patch('/admin/tickets/{ticket}/restore', [AdminTicketController::class, 'restore'])
    ->middleware('admin')
    ->name('admin.tickets.restore');