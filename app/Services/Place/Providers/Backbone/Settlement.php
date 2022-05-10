<?php

namespace App\Services\Place\Providers\Backbone;

use App\Services\Place\Exceptions\InvalidProviderDataException;
use App\Services\Place\Providers\SettlementInterface;
use App\Services\Place\Providers\SettlementTypeInterface;
use App\Services\Place\Providers\ValidatesData;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;

class Settlement implements SettlementInterface
{
    use ValidatesData;

    private const FIELD_KEY             = 'key';
    private const FIELD_NAME            = 'name';
    private const FIELD_ZONE_TYPE       = 'zone_type';
    private const FIELD_SETTLEMENT_TYPE = 'settlement_type';
    private const FIELDS                = [
        self::FIELD_KEY,
        self::FIELD_NAME,
        self::FIELD_ZONE_TYPE,
        self::FIELD_SETTLEMENT_TYPE,
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

    public function key(): int
    {
        return $this->raw->get(self::FIELD_KEY);
    }

    public function name(): string
    {
        return $this->raw->get(self::FIELD_NAME);
    }

    public function zoneType(): string
    {
        return $this->raw->get(self::FIELD_ZONE_TYPE);
    }

    public function settlementType(): SettlementTypeInterface
    {
        return App::make(SettlementType::class, ['raw' => $this->raw->get(self::FIELD_SETTLEMENT_TYPE)]);
    }
}
