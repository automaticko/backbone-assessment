<?php

namespace App\Http\Resources\Api\ZipCode\Show;

use App\Models\ZipCode;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property ZipCode $resource */
class FederalEntityResource extends JsonResource
{
    public function __construct(ZipCode $resource)
    {
        parent::__construct($resource);
    }

    public function toArray($request)
    {
        return [
            'key'  => $this->resource->federal_entity_key,
            'name' => $this->resource->federal_entity_name,
            'code' => $this->resource->federal_entity_code,
        ];
    }

    public static function jsonSchema(): array
    {
        return [
            'type'                 => ['object'],
            'properties'           => [
                'key'  => ['type' => ['integer']],
                'name' => ['type' => ['string']],
                'code' => ['type' => ['string', 'null']],
            ],
            'required'             => [
                'key',
                'name',
                'code',
            ],
            'additionalProperties' => false,
        ];
    }
}
