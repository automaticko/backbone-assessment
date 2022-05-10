<?php

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Collection::macro('recursive', function() {
            return $this->map(function($value) {
                if (is_array($value) || is_object($value)) {
                    return Collection::make($value)->recursive();
                }

                return $value;
            });
        });
    }
}
