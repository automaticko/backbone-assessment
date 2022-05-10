<?php

namespace App\Services\Place\Providers\Database;

use App\Services\Place\Exceptions\InvalidProviderDataException;
use App\Services\Place\Providers\FederalEntityInterface;
use App\Services\Place\Providers\ValidatesData;
use Illuminate\Support\Collection;

class FederalEntity implements FederalEntityInterface
{
    use ValidatesData;

    private const FIELD_KEY  = 'federal_entity_key';
    private const FIELD_NAME = 'federal_entity_name';
    private const FIELD_CODE = 'federal_entity_code';
    private const FIELDS     = [
        self::FIELD_KEY,
        self::FIELD_NAME,
        self::FIELD_CODE,
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

    public function code(): ?string
    {
        return $this->raw->get(self::FIELD_CODE);
    }
}
