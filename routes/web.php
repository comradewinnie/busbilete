<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\TicketController as AdminTicketController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\AccountRestoreController;
use App\Http\Controllers\FavoriteController;

// Start page

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/bus-locations', [MapController::class, 'busLocations'])
    ->name('map.busLocations');

// Language switcher

Route::post('/locale/{locale}', function (string $locale) {
    if (in_array($locale, config('app.available_locales'))) {
        session(['locale' => $locale]);
    }
    return back();
})->name('locale.switch');

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

// Account restoration

Route::get('/restore-account', [AccountRestoreController::class, 'show'])
    ->middleware('guest')
    ->name('account.restore.show');

Route::post('/restore-account', [AccountRestoreController::class, 'restore'])
    ->middleware('guest')
    ->name('account.restore');

Route::post('/restore-account/cancel', [AccountRestoreController::class, 'cancel'])
    ->middleware('guest')
    ->name('account.restore.cancel');

// User: tickets

Route::get('/tickets', [TicketController::class, 'index'])
    ->middleware('auth')
    ->name('tickets.index');

Route::get('/tickets/{ticket}', [TicketController::class, 'show'])
    ->middleware('auth')
    ->name('tickets.show');

// User: favorites

Route::get('/favorites', [FavoriteController::class, 'index'])
    ->middleware('auth')
    ->name('favorites.index');

Route::post('/favorites/{route}', [FavoriteController::class, 'store'])
    ->middleware('auth')
    ->name('favorites.store');
    
Route::delete('/favorites/{route}', [FavoriteController::class, 'destroy'])
    ->middleware('auth')
    ->name('favorites.destroy');

// Cart

Route::get('/cart', [CartController::class, 'index'])
->middleware('auth')
    ->name('cart.index');

Route::post('/cart', [CartController::class, 'add'])
    ->middleware('auth')
    ->name('cart.add');

Route::patch('/cart/{key}', [CartController::class, 'updateCategory'])
    ->middleware('auth')
    ->name('cart.updateCategory');

Route::delete('/cart/{key}', [CartController::class, 'remove'])
    ->middleware('auth')
    ->name('cart.remove');

// Checkout

Route::post('/checkout', [PaymentController::class, 'createSession'])
    ->name('checkout.create');

Route::get('/payment/success', [PaymentController::class, 'success'])
    ->name('payment.success');

Route::get('/payment/cancel', [PaymentController::class, 'cancel'])
    ->name('payment.cancel');

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