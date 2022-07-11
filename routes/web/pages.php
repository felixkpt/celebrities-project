<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::controller(PageController::class)->group(function() {
    Route::get('pages/', function() {
        return redirect()->back()->with('danger', 'Page not specified.');
    });
    Route::get('pages/{slug}', 'show')->name('pages.show');
});
