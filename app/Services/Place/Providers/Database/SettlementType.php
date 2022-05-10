<?php

namespace App\Services\Place\Providers\Database;

use App\Services\Place\Exceptions\InvalidProviderDataException;
use App\Services\Place\Providers\SettlementTypeInterface;
use App\Services\Place\Providers\ValidatesData;
use Illuminate\Support\Collection;

class SettlementType implements SettlementTypeInterface
{
    use ValidatesData;

    private const FIELD_NAME = 'type';
    private const FIELDS     = [
        self::FIELD_NAME,
    ];
    private Collection $raw;

    /**
     * @throws InvalidProviderDataException
     */
    public function __construct(Collection $raw)
    {
        $this->validate(self::FIELDS, $raw);

        $this->raw = $raw;
    }

    public function name(): string
    {
        return $this->raw->get(self::FIELD_NAME);
    }
}
