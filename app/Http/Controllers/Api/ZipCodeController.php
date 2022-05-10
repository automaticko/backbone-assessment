<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ZipCode\ShowResource;
use App\Models\ZipCode;
use Illuminate\Support\Facades\App;

class ZipCodeController extends Controller
{
    public function show(ZipCode $zipCode)
    {
        return App::make(ShowResource::class, ['resource' => $zipCode]);
    }
}
