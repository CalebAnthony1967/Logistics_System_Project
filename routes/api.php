<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DeliveryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;

Route::middleware([''])->group(function () {
    // Delivery endpoints
     Route::get('/deliveries', [DeliveryController::class, 'index'])->name('deliveries.index');
    Route::post('/deliveries/estimate', [DeliveryController::class, 'estimate'])->name('deliveries.estimate');
    Route::post('/deliveries', [DeliveryController::class, 'store'])->name('deliveries.store');
    Route::get('/deliveries/{delivery}', [DeliveryController::class, 'show'])->name('deliveries.show');
    Route::patch('/deliveries/{delivery}', [DeliveryController::class, 'update'])->name('deliveries.update');
    Route::post('/deliveries/{delivery}/rate', [DeliveryController::class, 'rate'])->name('deliveries.rate');
    Route::delete('/deliveries/{delivery}', [DeliveryController::class, 'destroy'])->name('deliveries.destroy');

    // Payment endpoint
    Route::post('/payments', [PaymentController::class, 'store']);

    // (Optional) API profile update
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
