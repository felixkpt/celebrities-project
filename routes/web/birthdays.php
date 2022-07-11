<?php

use App\Http\Controllers\BirthdayController;
use Illuminate\Support\Facades\Route;

Route::controller(BirthdayController::class)->group(function() {

    $year = '[0-9]+';
    $month = '[0-9]+';
    $day = '[0-9]+';
    Route::get('/birthdays', 'index')->name('birthdays');
    Route::get('/birthdays/year/{year}', 'year')->where(['year' => $year]);
    Route::get('/birthdays/year/{year}/month/{month}', 'yearMonth')->where(['year' => $year, 'month' => $month]);
    Route::get('/birthdays/month/{month}', 'month')->where(['month' => $month]);
    Route::get('/birthdays/day/{day}', 'day')->where(['day' => $day]);
    Route::get('/birthdays/month/{month}/day/{day}', 'monthDay')->where(['month' => $month, 'day' => $day]);
    Route::get('/birthdays/year/{year}/month/{month}/day/{day}', 'yearMonthDay')->where(['year' => $year, 'month' => $month, 'day' => $day]);

});