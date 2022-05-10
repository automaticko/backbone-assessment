<?php

namespace App\Http\Resources\Api\ZipCode\Show\Settlement;

use App\Services\Place\Providers\SettlementTypeInterface;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property SettlementTypeInterface $resource */
class SettlementTypeResource extends JsonResource
{
    public function __construct(SettlementTypeInterface $resource)
    {
        parent::__construct($resource);
    }

    public function toArray($request)
    {
        return [
            'name' => $this->resource->name(),
        ];
    }

    public static function jsonSchema(): array
    {
        return [
            'type'                 => ['object'],
            'properties'           => [
                'name' => ['type' => ['string']],
            ],
            'required'             => [
                'name',
            ],
            'additionalProperties' => false,
        ];
    }
}
