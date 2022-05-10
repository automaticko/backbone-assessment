<?php

use App\Constants\RouteNames;
use App\Constants\RouteParameters;
use App\Http\Controllers\Api\ZipCodeController;
use Illuminate\Support\Facades\Route;

Route::get('zip-codes/{' . RouteParameters::ZIP_CODE . '}', [ZipCodeController::class, 'show'])
    ->name(RouteNames::ZIP_CODE);
