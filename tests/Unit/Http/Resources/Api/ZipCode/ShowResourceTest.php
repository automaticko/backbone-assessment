<?php

namespace Tests\Unit\Http\Resources\Api\ZipCode;

use App\Http\Resources\Api\ZipCode\Show\FederalEntityResource;
use App\Http\Resources\Api\ZipCode\Show\MunicipalityResource;
use App\Http\Resources\Api\ZipCode\Show\SettlementResource;
use App\Http\Resources\Api\ZipCode\ShowResource;
use App\Models\Settlement;
use App\Models\ZipCode;
use Illuminate\Database\Eloquent\Collection;
use Mockery;
use Tests\TestCase;

class ShowResourceTest extends TestCase
{
    /** @test */
    public function it_has_correct_fields()
    {

        $zipCode = Mockery::mock(ZipCode::class);
        $zipCode->shouldReceive('getAttribute')->withArgs(['zip_code'])->once()->andReturn($code = '01000');

        $settlement = Mockery::mock(Settlement::class);
        $settlement->shouldReceive('getAttribute')->withArgs(['key'])->once()->andReturn(1);
        $settlement->shouldReceive('getAttribute')->withArgs(['name'])->once()->andReturn('');
        $settlement->shouldReceive('getAttribute')->withArgs(['zone'])->once()->andReturn('');
        $settlement->shouldReceive('getAttribute')->withArgs(['type'])->once()->andReturn('');

        $settlements = Collection::make([$settlement]);

        $zipCode->shouldReceive('getAttribute')->withArgs(['locality'])->once()->andReturn($locality = 'Locality');
        $zipCode->shouldReceive('getAttribute')->withArgs(['federal_entity_key'])->once()->andReturn(1);
        $zipCode->shouldReceive('getAttribute')->withArgs(['federal_entity_name'])->once()->andReturn('');
        $zipCode->shouldReceive('getAttribute')->withArgs(['federal_entity_code'])->once()->andReturn(null);
        $zipCode->shouldReceive('getAttribute')->withArgs(['settlements'])->once()->andReturn($settlements);
        $zipCode->shouldReceive('getAttribute')->withArgs(['municipality_key'])->once()->andReturn(1);
        $zipCode->shouldReceive('getAttribute')->withArgs(['municipality_name'])->once()->andReturn('');

        $resource = new ShowResource($zipCode);

        $expected = [
            'zip_code'       => $code,
            'locality'       => $locality,
            'federal_entity' => new FederalEntityResource($zipCode),
            'municipality'   => new MunicipalityResource($zipCode),
            'settlements'    => SettlementResource::collection($settlements),
        ];

        $actual = $resource->resolve();

        $this->assertEquals($expected, $actual);
        $this->assertValidSchema(ShowResource::jsonSchema(), json_decode(json_encode($actual)));
    }
}
