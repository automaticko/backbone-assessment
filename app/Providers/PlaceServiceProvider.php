<?php

namespace App\Providers;

use App\Services\PlaceService;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class PlaceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(PlaceService::class, function() {
            return new PlaceService(Config::get('place.provider'));
        });
    }
}
