<?php

namespace Tests\Unit\Services;

use App\Services\Place\Exceptions\InvalidProviderException;
use App\Services\Place\Providers\Fake;
use App\Services\Place\Providers\LocationInterface;
use App\Services\PlaceService;
use Illuminate\Support\Facades\App;
use Mockery;
use Tests\TestCase;

class PlaceServiceTest extends TestCase
{
    /** @test */
    public function it_throws_exception_on_invalid_provider()
    {
        $this->expectException(InvalidProviderException::class);

        new PlaceService('');
    }

    /** @test */
    public function it_returns_a_location_interface()
    {
        $service = new PlaceService('fake');

        $this->assertInstanceOf(LocationInterface::class, $service->locationByZipCode(''));
    }

    /** @test */
    public function it_caches_already_fetch_locations()
    {
        $zipCode = '01000';

        $location = Mockery::mock(LocationInterface::class);

        $provider = Mockery::mock(Fake::class);
        $provider->shouldReceive('findZipCode')->withArgs([$zipCode])->once()->andReturn($location);
        App::bind(Fake::class, fn() => $provider);

        $service = new PlaceService('fake');
        $service->locationByZipCode($zipCode);
        $service->locationByZipCode($zipCode);
    }
}
