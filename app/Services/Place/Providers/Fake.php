<?php

namespace App\Services\Place\Providers;

use App\Services\Place\ProviderInterface;
use Illuminate\Support\Collection;

class Fake implements ProviderInterface
{
    public function findZipCode(string $zipCode): LocationInterface
    {
        return new class(Collection::make([])) implements LocationInterface {
            public function __construct(Collection $raw)
            {
            }

            public function zipCode(): string
            {
                return '';
            }

            public function locality(): string
            {
                return '';
            }

            public function federalEntity(): FederalEntityInterface
            {
                return new class(Collection::make([])) implements FederalEntityInterface {
                    public function __construct(Collection $raw)
                    {
                    }

                    public function key(): int
                    {
                        return 1;
                    }

                    public function name(): string
                    {
                        return '';
                    }

                    public function code(): ?string
                    {
                        return null;
                    }
                };
            }

            public function settlements(): SettlementsInterface
            {
                return new class(Collection::make()) implements SettlementsInterface {
                    public function __construct(Collection $raw)
                    {
                    }

                    public function items(): Collection
                    {
                        $settlement = new class(Collection::make()) implements SettlementInterface {
                            public function __construct(Collection $raw)
                            {
                            }

                            public function key(): int
                            {
                                return 1;
                            }

                            public function name(): string
                            {
                                return '';
                            }

                            public function zoneType(): string
                            {
                                return '';
                            }

                            public function settlementType(): SettlementTypeInterface
                            {
                                return new class(Collection::make()) implements SettlementTypeInterface {
                                    public function __construct(Collection $raw)
                                    {
                                    }

                                    public function name(): string
                                    {
                                        return '';
                                    }
                                };
                            }
                        };

                        return Collection::make([
                            $settlement,
                        ]);
                    }
                };
            }

            public function municipality(): MunicipalityInterface
            {
                return new class(Collection::make([])) implements MunicipalityInterface {
                    public function __construct(Collection $raw)
                    {
                    }

                    public function key(): int
                    {
                        return 1;
                    }

                    public function name(): string
                    {
                        return '';
                    }
                };
            }
        };
    }
}
