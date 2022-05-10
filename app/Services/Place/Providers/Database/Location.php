<?php

namespace App\Services\Place\Providers\Database;

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

    const FIELD_ZIP_CODE            = 'zip_code';
    const FIELD_LOCALITY            = 'locality';
    const FIELD_FEDERAL_ENTITY_KEY  = 'federal_entity_key';
    const FIELD_FEDERAL_ENTITY_NAME = 'federal_entity_name';
    const FIELD_FEDERAL_ENTITY_CODE = 'federal_entity_code';
    const FIELD_SETTLEMENTS         = 'settlements';
    const FIELD_MUNICIPALITY_KEY    = 'municipality_key';
    const FIELD_MUNICIPALITY_NAME   = 'municipality_name';
    const FIELDS                    = [
        self::FIELD_ZIP_CODE,
        self::FIELD_LOCALITY,
        self::FIELD_FEDERAL_ENTITY_KEY,
        self::FIELD_FEDERAL_ENTITY_NAME,
        self::FIELD_FEDERAL_ENTITY_CODE,
        self::FIELD_SETTLEMENTS,
        self::FIELD_MUNICIPALITY_KEY,
        self::FIELD_MUNICIPALITY_NAME,
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
        $fields = Collection::make([
            self::FIELD_FEDERAL_ENTITY_KEY  => $this->raw->get(self::FIELD_FEDERAL_ENTITY_KEY),
            self::FIELD_FEDERAL_ENTITY_NAME => $this->raw->get(self::FIELD_FEDERAL_ENTITY_NAME),
            self::FIELD_FEDERAL_ENTITY_CODE => $this->raw->get(self::FIELD_FEDERAL_ENTITY_CODE),
        ]);

        return App::make(FederalEntity::class, ['raw' => $fields]);
    }

    public function settlements(): SettlementsInterface
    {
        return App::make(Settlements::class, ['raw' => $this->raw->get(self::FIELD_SETTLEMENTS)]);
    }

    public function municipality(): MunicipalityInterface
    {
        $fields = Collection::make([
            self::FIELD_MUNICIPALITY_KEY  => $this->raw->get(self::FIELD_MUNICIPALITY_KEY),
            self::FIELD_MUNICIPALITY_NAME => $this->raw->get(self::FIELD_MUNICIPALITY_NAME),
        ]);

        return App::make(Municipality::class, ['raw' => $fields]);
    }
}
