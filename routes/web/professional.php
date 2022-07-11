<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfessionalController;

Route::controller(ProfessionalController::class)->group(function () {
    // Route::get('/professional', 'index');
    Route::get('/professional/{slug}', 'show');
});