<?php

namespace Tests\Unit\Http\Resources\Api\ZipCode\Show;

use App\Http\Resources\Api\ZipCode\Show\Settlement\SettlementTypeResource;
use App\Http\Resources\Api\ZipCode\Show\SettlementResource;
use App\Models\Settlement;
use Mockery;
use Tests\TestCase;

class SettlementResourceTest extends TestCase
{
    /** @test */
    public function it_has_correct_fields()
    {
        $settlement = Mockery::mock(Settlement::class);
        $settlement->shouldReceive('getAttribute')->withArgs(['key'])->once()->andReturn($key = 1);
        $settlement->shouldReceive('getAttribute')->withArgs(['name'])->once()->andReturn($name = 'A name');
        $settlement->shouldReceive('getAttribute')->withArgs(['zone'])->once()->andReturn($zoneType = 'Zone type');
        $settlement->shouldReceive('getAttribute')->withArgs(['type'])->once()->andReturn('');

        $resource = new SettlementResource($settlement);

        $expected = [
            'key'             => $key,
            'name'            => $name,
            'zone_type'       => $zoneType,
            'settlement_type' => new SettlementTypeResource($settlement),
        ];

        $actual = $resource->resolve();

        $this->assertEquals($expected, $actual);
        $this->assertValidSchema(SettlementResource::jsonSchema(), json_decode(json_encode($actual)));
    }
}
