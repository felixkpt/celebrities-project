<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypologyController;
Route::get('/typologies', [TypologyController::class, 'index'])->name('typologies');
Route::get('/typologies/{slug}', [TypologyController::class, 'details']);
