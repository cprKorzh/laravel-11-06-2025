<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Главная страница
Route::get('/', [HomeController::class, 'index'])->name('home');

// Маршруты аутентификации
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Маршруты для заказов
    Route::middleware(['auth', 'user.role'])->group(function () {
        Route::get('/orders/create', [OrderController::class, 'showOrderForm'])->name('orders.create');
        Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    });
    
    Route::middleware('auth')->group(function () {
        Route::get('/orders/success/{order}', [OrderController::class, 'success'])->name('orders.success');
        Route::get('/profile/orders', [OrderController::class, 'userOrders'])->name('profile.orders');
    });
    
    // Маршруты для администратора
    Route::middleware('admin')->group(function () {
        Route::get('/admin/orders', [OrderController::class, 'adminOrders'])->name('admin.orders');
    });
});
