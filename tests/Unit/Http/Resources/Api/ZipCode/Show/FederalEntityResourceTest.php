<?php

namespace Tests\Unit\Http\Resources\Api\ZipCode\Show;

use App\Http\Resources\Api\ZipCode\Show\FederalEntityResource;
use App\Services\Place\Providers\FederalEntityInterface;
use Mockery;
use Tests\TestCase;

class FederalEntityResourceTest extends TestCase
{
    /** @test */
    public function it_has_correct_fields()
    {
        $federalEntity = Mockery::mock(FederalEntityInterface::class);
        $federalEntity->shouldReceive('key')->withNoArgs()->once()->andReturn($key = 1);
        $federalEntity->shouldReceive('name')->withNoArgs()->once()->andReturn($name = 'A name');
        $federalEntity->shouldReceive('code')->withNoArgs()->once()->andReturn($code = null);

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
