<?php

namespace App\Services\Place\Providers;

use Illuminate\Support\Collection;

interface SettlementTypeInterface
{
    public function __construct(Collection $raw);

    public function name(): string;
}
