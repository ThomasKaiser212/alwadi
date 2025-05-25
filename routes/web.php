<?php

use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MealController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
// المسارات العامة
// Route::get('/', function () {
//     return view('welcome');
// });



// مصادقة المستخدمين
Auth::routes();

// مسارات بعد تسجيل الدخول
Route::middleware(['auth', 'preventAdmin'])->group(function () {

    Route::get('/', function () {
        return redirect('/home');
    });

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
    Route::post('/book-rom', [BookingController::class, 'store'])->name('book-room.store');


    Route::get('/book-meal', [HomeController::class, 'bookMeal'])->name('book-meal.index');

    Route::get('/book-table', [HomeController::class, 'bookTable'])->name('book-table.index');
    Route::get('/book-taxi', [HomeController::class, 'bookTaxi'])->name('book-taxi.index');
    // مسار حجز الغرفة

    // مسارات حجز الطاولات
    Route::get('/reserve-table', [TableController::class, 'index'])->name('reserve-table.index');
    Route::post('/reserve-table', [TableController::class, 'store'])->name('reserve-table.store');

    // شغال نظامي مسارات حجز السيارات
    Route::get('/reserve-car', [CarController::class, 'index'])->name('reserve-car.index');
    Route::post('/reserve-car', [CarController::class, 'store'])->name('reserve-car.store');

    //   شغال مسارات طلب الوجبات
    Route::get('/order-meal', [MealController::class, 'index'])->name('order-meal.index');
    Route::post('/order-meal', [MealController::class, 'store'])->name('order-meal.store');


    //////////////////////////////////////////////////////////////////////////////
    // web.php
    Route::get('/my-bookings', [BookingController::class, 'index'])->name('my-bookings');
});



Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/orders', [BookingController::class, 'allbooking'])->name('admin.orders');


});

Route::get('/clear-cache',function () {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');

        return redirect()->back()->with('success', 'Cache has been cleared!');
    }
);
