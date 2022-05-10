<?php

namespace App\Services\Place\Providers;

use Illuminate\Support\Collection;

interface SettlementsInterface
{
    public function __construct(Collection $raw);

    public function items(): Collection;
}
