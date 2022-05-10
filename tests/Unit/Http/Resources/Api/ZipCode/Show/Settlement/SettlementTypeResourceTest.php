<?php

namespace Tests\Unit\Http\Resources\Api\ZipCode\Show\Settlement;

use App\Http\Resources\Api\ZipCode\Show\Settlement\SettlementTypeResource;
use App\Models\Settlement;
use Mockery;
use Tests\TestCase;

class SettlementTypeResourceTest extends TestCase
{
    /** @test */
    public function it_has_correct_fields()
    {
        $settlement = Mockery::mock(Settlement::class);
        $settlement->shouldReceive('getAttribute')->withArgs(['type'])->once()->andReturn($name = 'A name');

        $resource = new SettlementTypeResource($settlement);

        $expected = [
            'name' => $name,
        ];

        $actual = $resource->resolve();

        $this->assertSame($expected, $actual);
        $this->assertValidSchema(SettlementTypeResource::jsonSchema(), json_decode(json_encode($actual)));
    }
}
