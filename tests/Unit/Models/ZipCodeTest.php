<?php

namespace Tests\Unit\Models;

use App\Models\Settlement;
use App\Models\ZipCode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ZipCodeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_expected_columns()
    {
        $this->assertHasExpectedColumns((new ZipCode())->getTable(), [
            'id',
            'zip_code',
            'locality',
            'federal_entity_key',
            'federal_entity_name',
            'federal_entity_code',
            'municipality_key',
            'municipality_name',
        ]);
    }

    /** @test */
    public function it_has_settlements()
    {
        $zipCode = ZipCode::factory()->create();

        Settlement::factory()->usingZipCode($zipCode)->count($count = 10)->create();

        $related = $zipCode->settlements()->get();

        $this->assertCorrectRelation($related, Settlement::class, $count);
    }
}
