<?php

use App\Http\Controllers\UtilisateurController;
use App\Http\Middleware\LogRequests;
use Illuminate\Support\Facades\Route;

Route::middleware([LogRequests::class])->group(function () {
    Route::prefix('utilisateurs')->group(function () {
        Route::get('/', [UtilisateurController::class, 'index']);
        Route::get('/{id}', [UtilisateurController::class, 'show']);
        Route::put('/{id}', [UtilisateurController::class, 'update']);
        Route::delete('/{id}', [UtilisateurController::class, 'destroy']);
    });
});