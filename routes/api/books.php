<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Book\BookController;

Route::prefix('book')->group(function () {
    Route::get('/{id}/description', [BookController::class, 'getBookDescription'])->name('book.description');
    Route::get('/{id}/translate', [BookController::class, 'translate'])
        ->middleware('check-translate-of-book')
        ->name('book.translate');
});
