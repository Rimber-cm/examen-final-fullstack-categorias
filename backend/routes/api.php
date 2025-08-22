<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;

Route::prefix('categorias')->group(function () {
    Route::get('/', [CategoriaController::class, 'index'])->name('categorias.index');
    Route::post('/', [CategoriaController::class, 'store'])->name('categorias.store');
});