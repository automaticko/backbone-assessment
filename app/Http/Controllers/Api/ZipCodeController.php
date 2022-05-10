<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ZipCode\ShowResource;
use App\Services\PlaceService;
use Illuminate\Support\Facades\App;

class ZipCodeController extends Controller
{
    public function show(string $zipCode)
    {
        $placeService = App::make(PlaceService::class);

        return App::make(ShowResource::class, ['resource' => $placeService->locationByZipCode($zipCode)]);
    }
}
