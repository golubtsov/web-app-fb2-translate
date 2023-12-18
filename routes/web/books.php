<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Book\BookController;

Route::middleware(['web', 'check-level'])->group(function () {
    Route::get('/{level}/books', [BookController::class, 'index'])->name('level.books');
});
