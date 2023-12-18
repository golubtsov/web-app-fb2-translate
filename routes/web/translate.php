<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Translate\TranslateController;

Route::prefix('translate')->group(function () {
    Route::get('/{id}/download', [TranslateController::class, 'download'])
        ->middleware('check-translate')
        ->name('translate.download');
});
