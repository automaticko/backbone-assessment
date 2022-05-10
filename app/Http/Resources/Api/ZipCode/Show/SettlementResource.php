<?php

namespace App\Http\Resources\Api\ZipCode\Show;

use App\Http\Resources\Api\ZipCode\Show\Settlement\SettlementTypeResource;
use App\Services\Place\Providers\SettlementInterface;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

/** @property SettlementInterface $resource */
class SettlementResource extends JsonResource
{
    public function __construct(SettlementInterface $resource)
    {
        parent::__construct($resource);
    }

    public function toArray($request)
    {
        return [
            'key'             => $this->resource->key(),
            'name'            => $this->resource->name(),
            'zone_type'       => $this->resource->zoneType(),
            'settlement_type' => App::make(SettlementTypeResource::class,
                ['resource' => $this->resource->settlementType()]),
        ];
    }

    public static function jsonSchema(): array
    {
        return [
            'type'                 => ['object'],
            'properties'           => [
                'key'             => ['type' => ['integer']],
                'name'            => ['type' => ['string']],
                'zone_type'       => ['type' => ['string']],
                'settlement_type' => SettlementTypeResource::jsonSchema(),
            ],
            'required'             => [
                'key',
                'name',
                'zone_type',
                'settlement_type',
            ],
            'additionalProperties' => false,
        ];
    }
}
