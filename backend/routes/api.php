<?php

use App\Http\Controllers\SizeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->group(function(){
//    Route::prefix('ingredientes')->group(function () {
//        Route::get('/', 'IngredientController@index')->name('ingredient.index');
//        Route::get('/{id}', 'IngredientController@show')->name('ingredient.show');
//        Route::get('/create', 'IngredientController@create')->name('ingredient.create');
//        Route::post('/create', 'IngredientController@store')->name('ingredient.store');
//        Route::delete('/{id}', 'IngredientController@destroy')->name('ingredient.delete');
//    }); TODO - update controller

    Route::prefix('tamanhos')->group(function () {
        Route::get('/', [SizeController::class, 'index'])->name('sizes.index');
        Route::get('/{id}', [SizeController::class, 'show'])->name('sizes.show');
        Route::get('/criar', [SizeController::class, 'create'])->name('sizes.create');
        Route::post('/criar', [SizeController::class , 'store'])->name('sizes.store');
        Route::put('/editar/{id}', [SizeController::class, 'update'])->name('sizes.update');
        Route::delete('/deletar/{id}', [SizeController::class, 'delete'])->name('sizes.delete');
    });
});
