<?php

namespace Tests\Feature;

use App\Constants\RouteNames;
use App\Http\Controllers\Api\ZipCodeController;
use App\Http\Resources\Api\ZipCode\ShowResource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

/** @see ZipCodeController */
class ShowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Config::set('place.provider', 'fake');
    }

    private string $routeName = RouteNames::ZIP_CODE;

    /** @test */
    public function it_displays_a_location()
    {
        $route = URL::route($this->routeName, '01000');

        $response = $this->get($route);

        $response->assertStatus(Response::HTTP_OK);

        $this->validateResponseSchema(ShowResource::jsonSchema(), $response);
    }
}
