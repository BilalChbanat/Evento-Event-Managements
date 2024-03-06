<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
})->name('/');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('dashboard/categories/index', [CategoryController::class, 'index'])->name('categories.index');

    Route::get('dashboard/categories/create', [CategoryController::class, 'create'])->middleware(['auth', 'verified', 'role:admin'])->name('categories.create');
    Route::post('dashboard/categories/create', [CategoryController::class, 'store'])->middleware(['auth', 'verified', 'role:admin'])->name('categories.create');

    Route::get('dashboard/categories/{id}/edit', [CategoryController::class, 'edit'])->middleware(['auth', 'verified', 'role:admin'])->name('category.edit');
    Route::put('dashboard/categories/{id}/edit', [CategoryController::class, 'update'])->middleware(['auth', 'verified', 'role:admin'])->name('category.edit');

    Route::get('dashboard/categories/{id}/delete', [CategoryController::class, 'destroy'])->middleware(['auth', 'verified', 'role:admin'])->name('category.destroy');
});

Route::middleware(['auth', 'verified', 'role:admin|organizer'])->group(function () {
    Route::get('dashboard/events/index', [EventController::class, 'index'])->name('events.index');

    Route::get('dashboard/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('dashboard/events/create', [EventController::class, 'store'])->name('events.create');

    Route::get('dashboard/events/{id}/edit', [EventController::class, 'edit'])->name('event.edit');
    Route::put('dashboard/events/{id}/edit', [EventController::class, 'update'])->name('event.update');

    Route::get('dashboard/events/{id}/delete', [EventController::class, 'destroy'])->name('event.destroy');
});


Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('dashboard/events/is_active', [EventController::class, 'is_active'])->name('events.is_active');

    Route::get('dashboard/events/{id}/approve', [EventController::class, 'approve'])->name('events.approve');
    Route::get('dashboard/events/{id}/refuse', [EventController::class, 'refuse'])->name('events.refuse');

    Route::get('dashboard/events/{id}/edit', [EventController::class, 'edit'])->name('event.edit');
    Route::put('dashboard/events/{id}/edit', [EventController::class, 'update'])->name('event.update');
});

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('dashboard/users/index', [AuthenticatedSessionController::class, 'index'])->name('users.index');

    Route::get('dashboard/users/{id}/delete', [AuthenticatedSessionController::class, 'delete'])->name('event.destroy');
});


require __DIR__.'/auth.php';
