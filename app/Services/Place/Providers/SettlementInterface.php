<?php

namespace App\Services\Place\Providers;

use Illuminate\Support\Collection;

interface SettlementInterface
{
    public function __construct(Collection $raw);

    public function key(): int;

    public function name(): string;

    public function zoneType(): string;

    public function settlementType(): SettlementTypeInterface;
}
