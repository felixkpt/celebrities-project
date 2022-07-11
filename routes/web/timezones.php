<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimeZoneController;

Route::controller(TimeZoneController::class)->group(function() {

    Route::get('/timezones/{timezone}/{timezone_description}', 'show');
});