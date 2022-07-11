<?php
namespace App\Settings;
use Illuminate\Support\Facades\Config;
class Reviews {

    public static function config($key)
    {
        return Config::get('settings')['reviews'][$key];
    }

    public static function stars() {
        return self::config('stars');
    }
    
}