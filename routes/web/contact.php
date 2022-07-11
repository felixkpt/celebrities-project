<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::prefix('contact')->controller(ContactController::class)->group(function() {
    Route::get('/', 'show');
    Route::post('/', 'mailContactForm')->name('contact');
});