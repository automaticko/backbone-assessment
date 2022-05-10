<?php

namespace Tests\Unit\Services\Place\Providers\Backbone;

use App\Services\Place\Exceptions\InvalidProviderDataException;
use App\Services\Place\Providers\Backbone\FederalEntity;
use App\Services\Place\Providers\Backbone\Location;
use App\Services\Place\Providers\Backbone\Municipality;
use App\Services\Place\Providers\Backbone\Settlements;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Mockery;
use Tests\TestCase;

class LocationTest extends TestCase
{
    private string $zipCode  = '01000';
    private string $locality = 'name';

    /** @test */
    public function it_throws_exception_trying_to_instance_with_invalid_data()
    {
        $this->expectException(InvalidProviderDataException::class);

        new Location(Collection::make());
    }

    /**
     * @test
     * @throws InvalidProviderDataException
     */
    public function it_returns_zip_code()
    {
        $instance = new Location($this->validData());

        $this->assertSame($this->zipCode, $instance->zipCode());
    }

    /**
     * @test
     * @throws InvalidProviderDataException
     */
    public function it_returns_locality()
    {
        $instance = new Location($this->validData());

        $this->assertSame($this->locality, $instance->locality());
    }

    /**
     * @test
     * @throws InvalidProviderDataException
     */
    public function it_returns_federal_entity()
    {
        $federalEntity = Mockery::mock(FederalEntity::class);
        App::bind(FederalEntity::class, fn() => $federalEntity);

        $instance = new Location($this->validData());

        $this->assertEquals($federalEntity, $instance->federalEntity());
    }

    /**
     * @test
     * @throws InvalidProviderDataException
     */
    public function it_returns_settlements()
    {
        $settlements = Mockery::mock(Settlements::class);
        App::bind(Settlements::class, fn() => $settlements);

        $instance = new Location($this->validData());

        $this->assertEquals($settlements, $instance->settlements());
    }

    /**
     * @test
     * @throws InvalidProviderDataException
     */
    public function it_returns_municipality()
    {
        $municipality = Mockery::mock(Municipality::class);
        App::bind(Municipality::class, fn() => $municipality);

        $instance = new Location($this->validData());

        $this->assertEquals($municipality, $instance->municipality());
    }

    private function validData(): Collection
    {
        return Collection::make([
            'zip_code'       => $this->zipCode,
            'locality'       => $this->locality,
            'federal_entity' => Collection::make([]),
            'settlements'    => Collection::make([]),
            'municipality'   => Collection::make([]),
        ]);
    }
}
