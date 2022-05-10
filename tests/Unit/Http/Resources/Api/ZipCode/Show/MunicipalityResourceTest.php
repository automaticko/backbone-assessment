<?php

namespace Tests\Unit\Http\Resources\Api\ZipCode\Show;

use App\Http\Resources\Api\ZipCode\Show\MunicipalityResource;
use App\Services\Place\Providers\MunicipalityInterface;
use Mockery;
use Tests\TestCase;

class MunicipalityResourceTest extends TestCase
{
    /** @test */
    public function it_has_correct_fields()
    {
        $municipality = Mockery::mock(MunicipalityInterface::class);
        $municipality->shouldReceive('key')->withNoArgs()->once()->andReturn($key = 1);
        $municipality->shouldReceive('name')->withNoArgs()->once()->andReturn($name = 'A name');

        $resource = new MunicipalityResource($municipality);

        $expected = [
            'key'  => $key,
            'name' => $name,
        ];

        $actual = $resource->resolve();

        $this->assertSame($expected, $actual);
        $this->assertValidSchema(MunicipalityResource::jsonSchema(), json_decode(json_encode($actual)));
    }
}
