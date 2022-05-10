<?php

namespace App\Services\Place;

use App\Services\Place\Providers\LocationInterface;

interface ProviderInterface
{
    public function findZipCode(string $zipCode): LocationInterface;
}
