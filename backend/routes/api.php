<?php

use App\Http\Controllers\AcompanhamentoController;
use App\Http\Controllers\CoberturaController;
use App\Http\Controllers\CremeController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RecheioController;
use App\Http\Controllers\SizeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('orders', OrderController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
Route::apiResource('deliveries', DeliveryController::class)->only(['index', 'update']);
Route::apiResource('cremes', CremeController::class)->only(['index','update', 'destroy']);
Route::apiResource('recheios', RecheioController::class)->only('index','update', 'destroy');
Route::apiResource('acompanhamentos', AcompanhamentoController::class)->only('index','update', 'destroy');
Route::apiResource('coberturas', CoberturaController::class)->only('index','update', 'destroy');
Route::apiResource('ingredients', IngredientController::class)->only('index');
Route::apiResource('sizes', SizeController::class)->only(['index', 'update', 'destroy']);

