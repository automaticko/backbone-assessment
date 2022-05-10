<?php

namespace App\Services\Place\Providers;

use Illuminate\Support\Collection;

interface LocationInterface
{
    public function __construct(Collection $raw);

    public function zipCode(): string;

    public function locality(): string;

    public function federalEntity(): FederalEntityInterface;

    public function settlements(): SettlementsInterface;

    public function municipality(): MunicipalityInterface;
}
