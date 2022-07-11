<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;

Route::controller(CountryController::class)->group(function () {
    Route::get('/countries', 'index');
    Route::get('/countries/{slug}', 'show');
});