<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MBTIController;
Route::get('/mbti', [MBTIController::class, 'index'])->name('mbti');
Route::get('/mbti/{slug}', [MBTIController::class, 'details']);
