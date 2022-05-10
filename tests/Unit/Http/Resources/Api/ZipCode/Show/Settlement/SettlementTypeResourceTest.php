<?php

namespace Tests\Unit\Http\Resources\Api\ZipCode\Show\Settlement;

use App\Http\Resources\Api\ZipCode\Show\Settlement\SettlementTypeResource;
use App\Services\Place\Providers\SettlementTypeInterface;
use Mockery;
use Tests\TestCase;

class SettlementTypeResourceTest extends TestCase
{
    /** @test */
    public function it_has_correct_fields()
    {
        $settlementType = Mockery::mock(SettlementTypeInterface::class);
        $settlementType->shouldReceive('name')->withNoArgs()->once()->andReturn($name = 'A name');

        $resource = new SettlementTypeResource($settlementType);

        $expected = [
            'name' => $name,
        ];

        $actual = $resource->resolve();

        $this->assertSame($expected, $actual);
        $this->assertValidSchema(SettlementTypeResource::jsonSchema(), json_decode(json_encode($actual)));
    }
}
