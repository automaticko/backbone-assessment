<?php

namespace App\Services\Place\Providers\Backbone;

use App\Services\Place\Exceptions\InvalidProviderDataException;
use App\Services\Place\Providers\MunicipalityInterface;
use App\Services\Place\Providers\ValidatesData;
use Illuminate\Support\Collection;

class Municipality implements MunicipalityInterface
{
    use ValidatesData;

    private const FIELD_KEY  = 'key';
    private const FIELD_NAME = 'name';
    private const FIELDS     = [
        self::FIELD_KEY,
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

    public function key(): int
    {
        return $this->raw->get(self::FIELD_KEY);
    }

    public function name(): string
    {
        return $this->raw->get(self::FIELD_NAME);
    }
}
