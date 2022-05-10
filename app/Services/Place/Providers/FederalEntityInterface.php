<?php

namespace App\Services\Place\Providers;

use Illuminate\Support\Collection;

interface FederalEntityInterface
{
    public function __construct(Collection $raw);

    public function key(): int;

    public function name(): string;

    public function code(): ?string;
}
