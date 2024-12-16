<?php

use App\Http\Controllers\Event\EventCategoryController;
use App\Http\Controllers\Event\EventController;
use App\Http\Controllers\Event\EventRegistrantController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/beranda', [EventController::class, 'beranda'])->name('beranda');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin-only routes
    Route::middleware('role:admin')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::patch('/users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

        // Event category routes
        Route::get('/event-categories', [EventCategoryController::class, 'index'])->name('categories.index');
        Route::post('/event-categories', [EventCategoryController::class, 'store'])->name('categories.store');
        Route::get('/event-categories/{id}/edit', [EventCategoryController::class, 'edit'])->name('categories.edit');
        Route::patch('/event-categories/{id}', [EventCategoryController::class, 'update'])->name('categories.update');
        Route::delete('/event-categories/{id}', [EventCategoryController::class, 'destroy'])->name('categories.destroy');

        // Event routes
        Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
        Route::post('/events', [EventController::class, 'store'])->name('events.store');
        Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
        Route::patch('/events/{id}', [EventController::class, 'update'])->name('events.update');
        Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');

        // Payment approval and rejection routes
        Route::patch('/payments/{id}/approved', [PaymentController::class, 'approved'])->name('payments.approved');
        Route::patch('/payments/{id}/rejected', [PaymentController::class, 'rejected'])->name('payments.rejected');
    });

    // Admin and user access routes
    Route::middleware('role:admin,user')->group(function () {
        Route::get('events', [EventController::class, 'index'])->name('events.index');
        Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
        Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
        Route::get('/payments/{id}', [PaymentController::class, 'detail'])->name('payments.detail');
    });

    // User-specific routes
    Route::middleware('role:user')->group(function () {
        Route::get('/registrants', [EventRegistrantController::class, 'index'])->name('registrants.index');
        Route::post('/registrants/{id}', [EventRegistrantController::class, 'register'])->name('registrants.register');
        Route::patch('/payments/{id}', [PaymentController::class, 'update'])->name('payments.update');
    });
});

require __DIR__.'/auth.php';
