<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

use App\Http\Controllers\MyTestController;
use App\Models\Post;
use Glhd\Gretel\Routing\ResourceBreadcrumbs;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__.'/auth.php';
require __DIR__.'/web/home.php';
require __DIR__.'/web/typologies.php';
require __DIR__.'/web/people.php';
require __DIR__.'/web/countries.php';
require __DIR__.'/web/birthdays.php';
require __DIR__.'/web/timezones.php';
require __DIR__.'/web/posts.php';
require __DIR__.'/web/pages.php';
require __DIR__.'/web/authors.php';
require __DIR__.'/web/google-auth.php';
require __DIR__.'/web/contact.php';
require __DIR__.'/web/professional.php';
require __DIR__.'/web/enneagrams.php';

require __DIR__.'/web/admin.php';

Route::get('dev', [App\Http\Controllers\TestController::class, 'test']);
Route::get('cv', function() {
    return view('welcome');
});

// Route::name('admin.test.')->prefix('admin/test')->controller(MyTestController::class)->group(function() {
//     Route::get('/', 'index')->name('index')
//     ->breadcrumb('Test');
//     Route::get('/{slug}', 'show')->name('show')
//     ->breadcrumb('Show', '.index');
// });

//Fallback/Catchall Route
Route::fallback(function () {
    $title = 'Oops! Nothing was found';
    return view('errors.404', compact('title'));
});
