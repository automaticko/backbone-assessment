<?php

namespace App\Http\Resources\Api\ZipCode\Show;

use App\Services\Place\Providers\MunicipalityInterface;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property MunicipalityInterface $resource */
class MunicipalityResource extends JsonResource
{
    public function __construct(MunicipalityInterface $resource)
    {
        parent::__construct($resource);
    }

    public function toArray($request)
    {
        return [
            'key'  => $this->resource->key(),
            'name' => $this->resource->name(),
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
