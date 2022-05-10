<?php

namespace Tests\Unit\Services\Place\Providers;

use App\Services\Place\Providers\Backbone;
use App\Services\Place\Providers\Backbone\Location;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\TransferException;
use Illuminate\Support\Facades\App;
use Mockery;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\TestCase;

class BackboneTest extends TestCase
{
    /** @test */
    public function it_throws_not_found_exception_on_guzzle_exception()
    {
        $client = Mockery::mock(Client::class);
        $client->shouldReceive('request')->withAnyArgs()->once()->andThrows(TransferException::class);
        App::bind(Client::class, fn() => $client);

        $this->expectException(NotFoundHttpException::class);

        $provider = new Backbone();
        $provider->findZipCode('');
    }

    /** @test */
    public function it_throws_not_found_exception_on_not_ok_status_code()
    {
        $response = Mockery::mock(ResponseInterface::class);
        $response->shouldReceive('getStatusCode')->withNoArgs()->once()->andReturn(Response::HTTP_NOT_FOUND);

        $client = Mockery::mock(Client::class);
        $client->shouldReceive('request')->withAnyArgs()->once()->andReturn($response);
        App::bind(Client::class, fn() => $client);

        $this->expectException(NotFoundHttpException::class);

        $provider = new Backbone();
        $provider->findZipCode('');
    }

    /** @test */
    public function it_throws_not_found_exception_on_invalid_json_response()
    {
        $response = Mockery::mock(ResponseInterface::class);
        $response->shouldReceive('getStatusCode')->withNoArgs()->once()->andReturn(Response::HTTP_OK);
        $response->shouldReceive('getBody')->withNoArgs()->once()->andReturn('invalid json');

        $client = Mockery::mock(Client::class);
        $client->shouldReceive('request')->withAnyArgs()->once()->andReturn($response);
        App::bind(Client::class, fn() => $client);

        $this->expectException(NotFoundHttpException::class);

        $provider = new Backbone();
        $provider->findZipCode('');
    }

    /** @test */
    public function it_fetch_and_returns_a_location()
    {
        $location = Mockery::mock(Location::class);
        App::bind(Location::class, fn() => $location);

        $response = Mockery::mock(ResponseInterface::class);
        $response->shouldReceive('getStatusCode')->withNoArgs()->once()->andReturn(Response::HTTP_OK);
        $response->shouldReceive('getBody')->withNoArgs()->once()->andReturn('{}');

        $client = Mockery::mock(Client::class);
        $client->shouldReceive('request')->withAnyArgs()->once()->andReturn($response);
        App::bind(Client::class, fn() => $client);

        $provider = new Backbone();

        $this->assertSame($location, $provider->findZipCode(''));
    }
}
