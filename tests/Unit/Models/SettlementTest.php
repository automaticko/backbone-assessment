<?php

namespace Tests\Unit\Models;

use App\Models\Settlement;
use App\Models\ZipCode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SettlementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_expected_columns()
    {
        $this->assertHasExpectedColumns((new Settlement())->getTable(), [
            'id',
            'zip_code_id',
            'key',
            'name',
            'zone',
            'type',
        ]);
    }

    /** @test */
    public function it_belongs_to_a_zip_code()
    {
        $settlement = Settlement::factory()->create();

        $related = $settlement->zipCode()->first();

        $this->assertInstanceOf(ZipCode::class, $related);
    }
}
