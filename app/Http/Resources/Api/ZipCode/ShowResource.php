<?php

namespace App\Http\Resources\Api\ZipCode;

use App\Http\Resources\Api\ZipCode\Show\FederalEntityResource;
use App\Http\Resources\Api\ZipCode\Show\MunicipalityResource;
use App\Http\Resources\Api\ZipCode\Show\SettlementResource;
use App\Services\Place\Providers\LocationInterface;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

/** @property LocationInterface $resource */
class ShowResource extends JsonResource
{
    public static $wrap = null;

    public function __construct(LocationInterface $resource)
    {
        parent::__construct($resource);
    }

    public function toArray($request)
    {
        return [
            'zip_code'       => $this->resource->zipCode(),
            'locality'       => $this->resource->locality(),
            'federal_entity' => App::make(FederalEntityResource::class,
                ['resource' => $this->resource->federalEntity()]),
            'settlements'    => SettlementResource::collection($this->resource->settlements()->items()),
            'municipality'   => App::make(MunicipalityResource::class, ['resource' => $this->resource->municipality()]),
        ];
    }

    public static function jsonSchema(): array
    {
        return [
            'type'                 => ['object'],
            'properties'           => [
                'zip_code'       => ['type' => ['string']],
                'locality'       => ['type' => ['string']],
                'federal_entity' => FederalEntityResource::jsonSchema(),
                'settlements'    => [
                    'type'  => ['array'],
                    'items' => SettlementResource::jsonSchema(),
                ],
                'municipality'   => MunicipalityResource::jsonSchema(),
            ],
            'required'             => [
                'zip_code',
                'locality',
                'federal_entity',
                'settlements',
                'municipality',
            ],
            'additionalProperties' => false,
        ];
    }
}
