<?php

namespace Tests\Feature;

use App\Constants\RouteNames;
use App\Http\Controllers\Api\ZipCodeController;
use App\Http\Resources\Api\ZipCode\ShowResource;
use App\Models\ZipCode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

/** @see ZipCodeController */
class ShowTest extends TestCase
{
    use RefreshDatabase;

    private string $routeName = RouteNames::ZIP_CODE;

    /** @test */
    public function it_displays_a_location()
    {
        ZipCode::factory()->create([
            'zip_code' => $code = '01000',
        ]);

        $route = URL::route($this->routeName, $code);

        $response = $this->get($route);

        $response->assertStatus(Response::HTTP_OK);

        $this->validateResponseSchema(ShowResource::jsonSchema(), $response);
    }
}
