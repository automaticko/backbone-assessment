<?php

namespace App\Services\Place\Providers\Database;

use App\Services\Place\Exceptions\InvalidProviderDataException;
use App\Services\Place\Providers\SettlementsInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;

class Settlements implements SettlementsInterface
{
    private Collection $items;

    /**
     * @throws InvalidProviderDataException
     */
    public function __construct(Collection $raw)
    {
        if ($raw->isEmpty()) {
            throw new InvalidProviderDataException();
        }

        $this->items = $raw->map(function(Collection $rawItem) {
            return App::make(Settlement::class, ['raw' => $rawItem]);
        });
    }

    public function items(): Collection
    {
        return $this->items;
    }
}
