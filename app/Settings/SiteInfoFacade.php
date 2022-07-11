<?php 
namespace App\Settings;

use Illuminate\Support\Facades\Facade;

class SiteInfoFacade extends Facade {
    protected static function getFacadeAccessor()
    {
        // The Site is our service container key
        return 'SiteInfo';
    }
}