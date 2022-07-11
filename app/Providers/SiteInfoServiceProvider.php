<?php

namespace App\Providers;

use App\Information\SiteInfo;
use Illuminate\Support\ServiceProvider;

class SiteInfoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        return $this->app->bind('siteinfo', function() {
            return new SiteInfo();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        
    }
}
