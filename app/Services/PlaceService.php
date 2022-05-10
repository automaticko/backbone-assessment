<?php

namespace App\Services;

use App\Services\Place\Exceptions\InvalidProviderException;
use App\Services\Place\ProviderInterface;
use App\Services\Place\Providers\Backbone;
use App\Services\Place\Providers\Database;
use App\Services\Place\Providers\Fake;
use App\Services\Place\Providers\LocationInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;

class PlaceService
{
    private ProviderInterface $provider;
    private Collection        $locations;

    /**
     * @throws InvalidProviderException
     */
    public function __construct(string $provider)
    {
        $this->provider = match ($provider) {
            'database' => App::make(Database::class),
            'backbone' => App::make(Backbone::class),
            'fake'     => App::make(Fake::class),
            default    => throw new InvalidProviderException(),
        };

        $this->locations = Collection::make();
    }

    public function locationByZipCode(string $zipCode): LocationInterface
    {
        $location = $this->locations->get($zipCode) ?? $this->provider->findZipCode($zipCode);

        $this->locations->put($zipCode, $location);

        return $location;
    }
}
