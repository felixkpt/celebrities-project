<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;

Route::controller(PersonController::class)->name('people.')->group(function () {
    Route::get('/people', 'index')->name('index');
    Route::get('/people/typologies/{slug}', 'typology');
    Route::pattern('id', '[0-9]+');
    Route::get('/people/{id}/{slug}', 'person')->where(['id' => '[0-9]+']);
    Route::middleware('auth:web')->post('/people', 'vote')->name('vote');
});