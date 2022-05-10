<?php

namespace App\Http\Resources\Api\ZipCode\Show;

use App\Services\Place\Providers\FederalEntityInterface;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property FederalEntityInterface $resource */
class FederalEntityResource extends JsonResource
{
    public function __construct(FederalEntityInterface $resource)
    {
        parent::__construct($resource);
    }

    public function toArray($request)
    {
        return [
            'key'  => $this->resource->key(),
            'name' => $this->resource->name(),
            'code' => $this->resource->code(),
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
