<?php

namespace App\Services\Place\Providers;

use App\Models\ZipCode;
use App\Services\Place\ProviderInterface;
use App\Services\Place\Providers\Database\Location;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class Database implements ProviderInterface
{
    public function findZipCode(string $zipCode): LocationInterface
    {
        if (!($zipCode = ZipCode::with('settlements')->where('zip_code', $zipCode)->first())) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return App::make(Location::class, ['raw' => Collection::make($zipCode->toArray())->recursive()]);
    }
}
