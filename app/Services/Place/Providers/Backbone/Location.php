<?php

namespace App\Services\Place\Providers\Backbone;

use App\Services\Place\Exceptions\InvalidProviderDataException;
use App\Services\Place\Providers\FederalEntityInterface;
use App\Services\Place\Providers\LocationInterface;
use App\Services\Place\Providers\MunicipalityInterface;
use App\Services\Place\Providers\SettlementsInterface;
use App\Services\Place\Providers\ValidatesData;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;

class Location implements LocationInterface
{
    use ValidatesData;

    private const FIELD_ZIP_CODE       = 'zip_code';
    private const FIELD_LOCALITY       = 'locality';
    private const FIELD_FEDERAL_ENTITY = 'federal_entity';
    private const FIELD_SETTLEMENTS    = 'settlements';
    private const FIELD_MUNICIPALITY   = 'municipality';
    private const FIELDS               = [
        self::FIELD_ZIP_CODE,
        self::FIELD_LOCALITY,
        self::FIELD_FEDERAL_ENTITY,
        self::FIELD_SETTLEMENTS,
        self::FIELD_MUNICIPALITY,
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

    public function zipCode(): string
    {
        return $this->raw->get(self::FIELD_ZIP_CODE);
    }

    public function locality(): string
    {
        return $this->raw->get(self::FIELD_LOCALITY);
    }

    public function federalEntity(): FederalEntityInterface
    {
        return App::make(FederalEntity::class, ['raw' => $this->raw->get(self::FIELD_FEDERAL_ENTITY)]);
    }

    public function settlements(): SettlementsInterface
    {
        return App::make(Settlements::class, ['raw' => $this->raw->get(self::FIELD_SETTLEMENTS)]);
    }

    public function municipality(): MunicipalityInterface
    {
        return App::make(Municipality::class, ['raw' => $this->raw->get(self::FIELD_MUNICIPALITY)]);
    }
}
