<?php

namespace App\Services\Place\Providers;

use Illuminate\Support\Collection;

interface MunicipalityInterface
{
    public function __construct(Collection $raw);

    public function key(): int;

    public function name(): string;
}
