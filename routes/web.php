<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MProductController;
use App\Http\Controllers\MTransactionController;
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
    return view('user.index');
});

Route::get('/admin', [MProductController::class, 'index'])->middleware(['auth', 'verified'])->name('admin');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // route admin
    Route::get('/admin', [MProductController::class, 'index'])->name('admin.index');
    Route::get('/admin/products/create', [MProductController::class, 'create'])->name('admin.create');
    Route::post('/admin/products', [MProductController::class, 'store'])->name('admin.store');
    Route::get('/admin/products/{id}/edit', [MProductController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/products/{id}', [MProductController::class, 'update'])->name('admin.update');
    Route::delete('/admin/products/{id}', [MProductController::class, 'destroy'])->name('admin.destroy');
    
    Route::get('/admin/transactions/create', [MTransactionController::class, 'create'])->name('transactions.create');
});

require __DIR__.'/auth.php';
