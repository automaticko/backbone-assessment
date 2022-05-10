<?php

namespace App\Http\Resources\Api\ZipCode\Show;

use App\Models\ZipCode;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property ZipCode $resource */
class MunicipalityResource extends JsonResource
{
    public function __construct(ZipCode $resource)
    {
        parent::__construct($resource);
    }

    public function toArray($request)
    {
        return [
            'key'  => $this->resource->municipality_key,
            'name' => $this->resource->municipality_name,
        ];
    }

    public static function jsonSchema(): array
    {
        return [
            'type'                 => ['object'],
            'properties'           => [
                'key'  => ['type' => ['integer']],
                'name' => ['type' => ['string']],
            ],
            'required'             => [
                'key',
                'name',
            ],
            'additionalProperties' => false,
        ];
    }
}
