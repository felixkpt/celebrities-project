<?php
namespace App\Settings;
use Illuminate\Support\Facades\Config;
class SiteInfo {

    public static function config($key)
    {
        return Config::get('settings')['siteInfo'][$key];
    }

    public static function name() {
        return static::config('name');
    }
    public static function title() {
        return static::config('title');
    }
    public static function description() {
        return self::config('description');
    }
    
}