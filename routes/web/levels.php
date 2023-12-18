<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Level\LevelController;

Route::middleware(['web'])->group(function () {
    Route::get('/', [LevelController::class, 'index'])->name('main');
});
