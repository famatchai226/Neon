<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\MyPurchasesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductShowController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Pages publiques
Route::get('/', ProductController::class)->name('products.index');
Route::get('/products/{product}', ProductShowController::class)->name('products.show');

// Téléchargement (pas besoin d'être connecté, le token fait foi)
Route::get('/download/{token}', DownloadController::class)->name('download');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Commandes
    Route::post('/orders/{product}', OrderController::class)->name('orders.store');
    Route::get('/orders/{order}/payment', [PaymentController::class, 'show'])->name('orders.payment');
    Route::post('/orders/{order}/payment/simulate', [PaymentController::class, 'simulate'])->name('orders.payment.simulate');

    // Mes achats
    Route::get('/my-purchases', MyPurchasesController::class)->name('my-purchases');
    Route::post('/my-purchases/{order}/download', [MyPurchasesController::class, 'download'])->name('my-purchases.download');
});

// Routes admin
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', AdminProductController::class);
});

require __DIR__.'/auth.php';
