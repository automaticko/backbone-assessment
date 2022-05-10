<?php

namespace Tests\Unit\Services\Place\Providers\Database;

use App\Services\Place\Exceptions\InvalidProviderDataException;
use App\Services\Place\Providers\Database\Settlement;
use App\Services\Place\Providers\Database\SettlementType;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Mockery;
use Tests\TestCase;

class SettlementTest extends TestCase
{
    private int    $key      = 1;
    private string $name     = 'name';
    private string $zoneType = 'zone';

    /**
     * @throws InvalidProviderDataException
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->rawSettlementType = Collection::make(['type' => 'settlement type name']);
        $this->settlementType    = new SettlementType($this->rawSettlementType);
    }

    /** @test */
    public function it_throws_exception_trying_to_instance_with_invalid_data()
    {
        $this->expectException(InvalidProviderDataException::class);

        new Settlement(Collection::make());
    }

    /**
     * @test
     * @throws InvalidProviderDataException
     */
    public function it_returns_key()
    {
        $instance = new Settlement($this->validData());

        $this->assertSame($this->key, $instance->key());
    }

    /**
     * @test
     * @throws InvalidProviderDataException
     */
    public function it_returns_name()
    {
        $instance = new Settlement($this->validData());

        $this->assertSame($this->name, $instance->name());
    }

    /**
     * @test
     * @throws InvalidProviderDataException
     */
    public function it_returns_zone_type()
    {
        $instance = new Settlement($this->validData());

        $this->assertSame($this->zoneType, $instance->zoneType());
    }

    /**
     * @test
     * @throws InvalidProviderDataException
     */
    public function it_returns_settlement_type()
    {
        $settlementType = Mockery::mock(SettlementType::class);
        App::bind(SettlementType::class, fn() => $settlementType);

        $instance = new Settlement($this->validData());

        $this->assertEquals($settlementType, $instance->settlementType());
    }

    private function validData(): Collection
    {
        return Collection::make([
            'key'  => $this->key,
            'name' => $this->name,
            'zone' => $this->zoneType,
            'type' => Collection::make([]),
        ]);
    }
}
