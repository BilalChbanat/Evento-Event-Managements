<?php

use App\Http\Controllers\CategoryController;
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
});

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
    Route::get('dashboard/categories/index', [CategoryController::class, 'index'])->name('categories.index');

    Route::get('dashboard/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('dashboard/categories/create', [CategoryController::class, 'store'])->name('categories.store');

    Route::get('dashboard/categories/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('dashboard/categories/{id}/edit', [CategoryController::class, 'update'])->name('category.update');

    Route::get('dashboard/categories/{id}/delete', [CategoryController::class, 'destroy'])->name('category.destroy');
});

require __DIR__.'/auth.php';
