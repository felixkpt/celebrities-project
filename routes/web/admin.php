<?php

use Illuminate\Support\Facades\Route;
use Glhd\Gretel\Routing\ResourceBreadcrumbs;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\TypologyController;
use App\Http\Controllers\Admin\PersonController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MediaLibraryController;

Route::middleware('role:Admin')->name('admin.')->prefix('/admin')->group(function () {

    Route::get('/', [AdminController::class, 'index'])->name('index')
        ->breadcrumb('Dashboard');

    Route::name('people.')->prefix('/people')->controller(PersonController::class)->group(function () {
        Route::get('/', 'index')->name('index')
            ->breadcrumb('People', 'admin.index');
        Route::get('/create', 'create')->name('create')
            ->breadcrumb('Edit', '.index');
        Route::get('/fetch', 'fetch')->name('fetch')
            ->breadcrumb('Fetch', '.index');
        Route::get('/{id}/edit', 'edit')
            ->breadcrumb('Edit', '.index');
        Route::post('/', 'store');
        Route::post('/fetch', 'fetcher')->name('fetcher');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('delete');
    });

    Route::name('typologies.')->prefix('/typologies')->controller(TypologyController::class)->group(function () {
        Route::get('/', 'index')->name('index')
            ->breadcrumb('Typologies', 'admin.index');
        Route::get('/create', 'create')->name('create')
            ->breadcrumb('Create', '.index');
        Route::get('/{typology}/edit', 'edit')->name('edit')
            ->breadcrumb('Edit', '.index');
        Route::post('/', 'store');
        Route::patch('/{typology}', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
    });

    Route::name('posts.')->prefix('/posts')->controller(PostController::class)->group(function () {
        Route::get('/', 'index')->name('index')
            ->breadcrumb('Posts', 'admin.index');
        Route::get('/create', 'create')->name('create')
            ->breadcrumb('Create', '.index');
        Route::get('/{id}/edit', 'edit')->name('edit')
            ->breadcrumb('Edit', '.index');
        Route::post('/', 'store')->name('store');
        Route::patch('/{id}', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
    });

    Route::name('pages.')->prefix('/pages')->controller(PageController::class)->group(function () {
        Route::get('/', 'index')->name('index')
            ->breadcrumb('Pages', 'admin.index');
        Route::get('/create', 'create')->name('create')
            ->breadcrumb('Create', '.index');
        Route::get('/{id}/edit', 'edit')->name('edit')
            ->breadcrumb('Edit', '.index');
        Route::post('/', 'store')->name('store');
        Route::patch('/{id}', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
    });


    Route::name('users.')->prefix('/users')->controller(UserController::class)->group(function () {
        Route::get('/', 'index')->name('index')
            ->breadcrumb('Users', 'admin.index');
        Route::get('/create', 'create')->name('create')
            ->breadcrumb('Create', '.index');
        Route::get('/{user}/show', 'show')->name('show')
            ->breadcrumb('Show', '.index');
        Route::get('/{user}/edit', 'edit')->name('edit')
            ->breadcrumb('Edit', '.index');
        Route::post('/', 'store')->name('store');
        Route::patch('/{user}', 'update')->name('update');
        Route::delete('/{user}', 'destroy')->name('destroy');
    });

    Route::name('users.roles.')->prefix('users/roles')->controller(UserRoleController::class)->group(function () {
        Route::get('/', 'index')->name('index')
            ->breadcrumb('Roles', 'admin.index');
        Route::get('/create', 'create')->name('create')
            ->breadcrumb('Create', '.index');
        Route::get('/{role}/show', 'show')->name('show')
            ->breadcrumb('Show', '.index');
        Route::get('/{role}/edit', 'edit')->name('edit')
            ->breadcrumb('Edit', '.index');
        Route::post('/', 'store')->name('store');
        Route::patch('/{role}', 'update')->name('update');
        Route::delete('/{role}', 'destroy')->name('destroy');
    });

    Route::name('schedules.')->prefix('schedules')->controller(ScheduleController::class)->group(function () {
        Route::get('/', 'index')->name('index')
            ->breadcrumb('Schedules', 'admin.index');
        Route::get('/create', 'create')->name('create')
            ->breadcrumb('Create', '.index');
        Route::get('/{role}/show', 'show')->name('show')
            ->breadcrumb('Show', '.index');
        Route::get('/{role}/edit', 'edit')->name('edit')
            ->breadcrumb('Edit', '.index');
        Route::post('/', 'store')->name('store');
        Route::patch('/{role}', 'update')->name('update');
        Route::delete('/{role}', 'destroy')->name('destroy');
    });

    Route::name('categories.')->prefix('/categories')->controller(CategoryController::class)->group(function () {
        Route::get('/', 'index')->name('index')
            ->breadcrumb('Categories', 'admin.index');
        Route::get('/create', 'create')->name('create')
            ->breadcrumb('Create', '.index');
        Route::get('/{id}/edit', 'edit')->name('edit')
            ->breadcrumb('Edit', '.index');
        Route::post('/', 'store')->name('store');
        Route::patch('/{id}', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
    });

    Route::name('media.')->prefix('/media')->controller(MediaLibraryController::class)->group(function () {
        Route::get('/', 'index')->name('index')
            ->breadcrumb('Media', 'admin.index');
        Route::get('/create', 'create')->name('create')
            ->breadcrumb('Create', '.index');
        Route::get('/{id}', 'show')->name('show')
            ->breadcrumb('Show', '.index');
        Route::get('/{id}/edit', 'edit')->name('edit')
            ->breadcrumb('Edit', '.index');
        Route::post('/', 'store')->name('store');
        Route::patch('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });
});
