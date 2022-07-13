<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnneagramController;
Route::get('/enneagrams', [EnneagramController::class, 'index'])->name('enneagrams');
Route::get('/enneagrams/{slug}', [EnneagramController::class, 'details']);
