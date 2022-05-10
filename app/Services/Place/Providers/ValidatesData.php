<?php

namespace App\Services\Place\Providers;

use App\Services\Place\Exceptions\InvalidProviderDataException;
use Illuminate\Support\Collection;

trait ValidatesData
{
    /**
     * @throws InvalidProviderDataException
     */
    private function validate(array $fields, Collection $raw): void
    {
        Collection::make($fields)->each(function(string $field) use ($raw) {
            if (!$raw->has($field)) {
                throw new InvalidProviderDataException();
            }
        });
    }
}
