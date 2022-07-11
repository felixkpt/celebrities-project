<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;

// Google URL
Route::prefix('google')->controller(GoogleController::class)->name('google.')->group( function(){
    Route::get('login', [GoogleController::class, 'loginWithGoogle'])->name('login');
    Route::any('callback', [GoogleController::class, 'callbackFromGoogle'])->name('callback');
});