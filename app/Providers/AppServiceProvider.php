<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Information\Site;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Site', function() {
            return new Site();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
