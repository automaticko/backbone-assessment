<?php

namespace Tests\Unit\Http\Resources\Api\ZipCode;

use App\Http\Resources\Api\ZipCode\Show\FederalEntityResource;
use App\Http\Resources\Api\ZipCode\Show\MunicipalityResource;
use App\Http\Resources\Api\ZipCode\Show\SettlementResource;
use App\Http\Resources\Api\ZipCode\ShowResource;
use App\Services\Place\Providers\FederalEntityInterface;
use App\Services\Place\Providers\LocationInterface;
use App\Services\Place\Providers\MunicipalityInterface;
use App\Services\Place\Providers\SettlementsInterface;
use Illuminate\Support\Collection;
use Mockery;
use Tests\TestCase;

class ShowResourceTest extends TestCase
{
    /** @test */
    public function it_has_correct_fields()
    {
        $settlements = $this->settlements();

        $federalEntity = $this->federalEntity();
        $municipality  = $this->municipality();

        $show = Mockery::mock(LocationInterface::class);
        $show->shouldReceive('zipCode')->withNoArgs()->once()->andReturn($zipCode = '01000');
        $show->shouldReceive('locality')->withNoArgs()->once()->andReturn($locality = 'Locality');
        $show->shouldReceive('federalEntity')->withNoArgs()->once()->andReturn($federalEntity);
        $show->shouldReceive('municipality')->withNoArgs()->once()->andReturn($municipality);
        $show->shouldReceive('settlements')->withNoArgs()->once()->andReturn($settlements);

        $resource = new ShowResource($show);

        $expected = [
            'zip_code'       => $zipCode,
            'locality'       => $locality,
            'federal_entity' => new FederalEntityResource($federalEntity),
            'municipality'   => new MunicipalityResource($municipality),
            'settlements'    => SettlementResource::collection($settlements->items()),
        ];

        $actual = $resource->resolve();

        $this->assertEquals($expected, $actual);
        $this->assertValidSchema(ShowResource::jsonSchema(), json_decode(json_encode($actual)));
    }

    private function federalEntity(): FederalEntityInterface
    {
        return new class(Collection::make([])) implements FederalEntityInterface {
            public function __construct(Collection $raw)
            {
            }

            public function key(): int
            {
                return 1;
            }

            public function name(): string
            {
                return '';
            }

            public function code(): ?string
            {
                return null;
            }
        };
    }

    private function settlements(): SettlementsInterface
    {
        return new class(Collection::make([])) implements SettlementsInterface {
            public function __construct(Collection $raw)
            {
            }

            public function items(): Collection
            {
                return Collection::make([]);
            }
        };
    }

    private function municipality(): MunicipalityInterface
    {
        return new class(Collection::make([])) implements MunicipalityInterface {
            public function __construct(Collection $raw)
            {
            }

            public function key(): int
            {
                return 1;
            }

            public function name(): string
            {
                return '';
            }
        };
    }
}
