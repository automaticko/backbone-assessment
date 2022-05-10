<?php

namespace Tests\Unit\Http\Resources\Api\ZipCode\Show;

use App\Http\Resources\Api\ZipCode\Show\Settlement\SettlementTypeResource;
use App\Http\Resources\Api\ZipCode\Show\SettlementResource;
use App\Services\Place\Providers\SettlementInterface;
use App\Services\Place\Providers\SettlementTypeInterface;
use Illuminate\Support\Collection;
use Mockery;
use Tests\TestCase;

class SettlementResourceTest extends TestCase
{
    /** @test */
    public function it_has_correct_fields()
    {
        $settlementType = $this->settlementType();

        $settlement = Mockery::mock(SettlementInterface::class);
        $settlement->shouldReceive('key')->withNoArgs()->once()->andReturn($key = 1);
        $settlement->shouldReceive('name')->withNoArgs()->once()->andReturn($name = 'A name');
        $settlement->shouldReceive('zoneType')->withNoArgs()->once()->andReturn($zoneType = 'Zone type');
        $settlement->shouldReceive('settlementType')->withNoArgs()->once()->andReturn($settlementType);

        $resource = new SettlementResource($settlement);

        $expected = [
            'key'             => $key,
            'name'            => $name,
            'zone_type'       => $zoneType,
            'settlement_type' => new SettlementTypeResource($settlementType),
        ];

        $actual = $resource->resolve();

        $this->assertEquals($expected, $actual);
        $this->assertValidSchema(SettlementResource::jsonSchema(), json_decode(json_encode($actual)));
    }

    private function settlementType(): SettlementTypeInterface
    {
        return new class (Collection::make()) implements SettlementTypeInterface {
            public function __construct(Collection $raw)
            {
            }

            public function name(): string
            {
                return 'Settlement type name';
            }
        };
    }
}
