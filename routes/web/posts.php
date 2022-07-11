<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::controller(PostController::class)->group(function() {
    Route::get('posts/', 'index')->name('posts');
    Route::get('posts/{slug}', 'show')->name('posts.show');
});
