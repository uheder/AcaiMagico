<?php

use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SizeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->group(function(){
    Route::prefix('ingredientes')->group(function () {
        Route::get('/', [IngredientController::class, 'index'])->name('ingredient.index');
        Route::get('/{id}', [IngredientController::class, 'show'])->name('ingredient.show');
        Route::get('/criar', [IngredientController::class, 'create'])->name('ingredient.create');
        Route::post('/criar', [IngredientController::class, 'store'])->name('ingredient.store');
        Route::get('/editar/{id}', [IngredientController::class, 'edit'])->name('ingredient.edit');
        Route::patch('/editar/{id}', [IngredientController::class, 'update'])->name('ingredient.update');
        Route::delete('/deletar/{id}', [IngredientController::class, 'delete'])->name('ingredient.delete');
    });

    Route::prefix('tamanhos')->group(function () {
        Route::get('/', [SizeController::class, 'index'])->name('sizes.index');
        Route::get('/{id}', [SizeController::class, 'show'])->name('sizes.show');
        Route::get('/criar', [SizeController::class, 'create'])->name('sizes.create');
        Route::post('/criar', [SizeController::class , 'store'])->name('sizes.store');
        Route::get('/editar/{id}', [SizeController::class, 'edit'])->name('sizes.edit');
        Route::patch('/editar/{id}', [SizeController::class, 'update'])->name('sizes.update');
        Route::delete('/deletar/{id}', [SizeController::class, 'delete'])->name('sizes.delete');

    });

    Route::prefix('entregas')->group(function () {
        Route::get('/', [DeliveryController::class, 'index'])->name('deliveries.index');
        Route::get('/{id}', [DeliveryController::class, 'show'])->name('deliveries.show');
    });

    Route::prefix('pedidos')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/{id}', [OrderController::class, 'show'])->name('orders.show');
        Route::get('/criar', [OrderController::class, 'store'])->name('orders.create');
        Route::post('/criar', [OrderController::class, 'store'])->name('orders.store');
        Route::patch('/editar_status/{id}', [OrderController::class, 'update'])->name('orders.update');
        Route::delete('/deletar/{id}', [OrderController::class, 'delete'])->name('orders.delete');
    });
});
