<?php

use App\Http\Controllers\Event\EventCategoryController;
use App\Http\Controllers\Event\EventController;
use App\Http\Controllers\Event\EventRegistrantController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EventController::class, 'welcome'])->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('role:admin')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit')->whereNumber('id');
        Route::patch('/users/{id}', [UserController::class, 'update'])->name('users.update')->whereNumber('id');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy')->whereNumber('id');

        Route::get('/event-categories', [EventCategoryController::class, 'index'])->name('categories.index');
        Route::post('/event-categories', [EventCategoryController::class, 'store'])->name('categories.store');
        Route::get('/event-categories/{id}', [EventCategoryController::class, 'edit'])->name('categories.edit')->whereNumber('id');
        Route::patch('/event-categories/{id}', [EventCategoryController::class, 'update'])->name('categories.update')->whereNumber('id');
        Route::delete('/event-categories/{id}', [EventCategoryController::class, 'destroy'])->name('categories.destroy')->whereNumber('id');

        Route::get('/events/create', [EventController::class, 'create'])->name('events.create')->whereNumber('id');
        Route::post('/events', [EventController::class, 'store'])->name('events.store');
        Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit')->whereNumber('id');
        Route::patch('/events/{id}', [EventController::class, 'update'])->name('events.update')->whereNumber('id');
        Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy')->whereNumber('id');
    });

    Route::middleware('role:admin,user')->group(function () {
        Route::get('events', [EventController::class, 'index'])->name('events.index');
        Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show')->whereNumber('id');
    });

    Route::middleware('role:user')->group(function () {
        Route::get('/registrants', [EventRegistrantController::class, 'index'])->name('registrants.index');
        Route::post('/registrants/{id}', [EventRegistrantController::class, 'register'])->name('registrants.register')->whereNumber('id');
    });
});

require __DIR__.'/auth.php';
