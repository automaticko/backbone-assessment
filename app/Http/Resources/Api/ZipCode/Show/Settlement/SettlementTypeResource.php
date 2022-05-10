<?php

namespace App\Http\Resources\Api\ZipCode\Show\Settlement;

use App\Models\Settlement;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property Settlement $resource */
class SettlementTypeResource extends JsonResource
{
    public function __construct(Settlement $resource)
    {
        parent::__construct($resource);
    }

    public function toArray($request)
    {
        return [
            'name' => $this->resource->type,
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
