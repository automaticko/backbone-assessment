<?php

namespace Tests\Unit\Http\Resources\Api\ZipCode\Show;

use App\Http\Resources\Api\ZipCode\Show\FederalEntityResource;
use App\Models\ZipCode;
use Mockery;
use Tests\TestCase;

class FederalEntityResourceTest extends TestCase
{
    /** @test */
    public function it_has_correct_fields()
    {
        $federalEntity = Mockery::mock(ZipCode::class);
        $federalEntity->shouldReceive('getAttribute')->withArgs(['federal_entity_key'])->once()->andReturn($key = 1);
        $federalEntity->shouldReceive('getAttribute')
            ->withArgs(['federal_entity_name'])
            ->once()
            ->andReturn($name = 'A name');
        $federalEntity->shouldReceive('getAttribute')
            ->withArgs(['federal_entity_code'])
            ->once()
            ->andReturn($code = null);

        $resource = new FederalEntityResource($federalEntity);

        $expected = [
            'key'  => $key,
            'name' => $name,
            'code' => $code,
        ];

        $actual = $resource->resolve();

        $this->assertSame($expected, $actual);
        $this->assertValidSchema(FederalEntityResource::jsonSchema(), json_decode(json_encode($actual)));
    }
}
