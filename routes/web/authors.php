<?php

use App\Http\Controllers\AuthorController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthorController::class)->group(function() {

    Route::get('/authors', 'index');
    Route::get('/authors/{author}', 'show');
    Route::get('/authors/{author}/lead', 'lead');

});