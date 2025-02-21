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


Route::apiResource('pedidos', OrderController::class)->only(['index', 'store', 'update', 'delete']);
Route::apiResource('entregas', DeliveryController::class)->only(['index', 'update']);
Route::apiResource('cremes', CremeController::class)->only('index','update', 'delete');
Route::apiResource('recheios', RecheioController::class)->only('index','update', 'delete');
Route::apiResource('acompanhamentos', AcompanhamentoController::class)->only('index','update', 'delete');
Route::apiResource('coberturas', CoberturaController::class)->only('index','update', 'delete');
Route::apiResource('ingredientes', IngredientController::class)->only('index');
Route::apiResource('tamanhos', SizeController::class)->only(['index', 'update', 'delete']);

