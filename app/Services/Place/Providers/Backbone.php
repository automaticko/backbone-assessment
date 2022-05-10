<?php

namespace App\Services\Place\Providers;

use App\Services\Place\ProviderInterface;
use App\Services\Place\Providers\Backbone\Location;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class Backbone implements ProviderInterface
{
    public function findZipCode(string $zipCode): LocationInterface
    {
        $endpoint = "https://jobs.backbonesystems.io/api/zip-codes/{$zipCode}";
        /** @var Client $client */
        $client = App::make(Client::class);

        try {
            $response = $client->request('GET', $endpoint);
        } catch (GuzzleException) {
            abort(Response::HTTP_NOT_FOUND);
        }

        if (Response::HTTP_OK !== $response->getStatusCode()) {
            abort(Response::HTTP_NOT_FOUND);
        }

        if (null === ($array = json_decode($response->getBody()))) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return App::make(Location::class, ['raw' => Collection::make($array)->recursive()]);
    }
}
