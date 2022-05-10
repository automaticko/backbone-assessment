<?php

namespace Tests\Unit\Services\Place\Providers;

use App\Services\Place\Exceptions\InvalidProviderDataException;
use App\Services\Place\Providers\ValidatesData;
use Illuminate\Support\Collection;
use Tests\TestCase;

class ValidatesDataTest extends TestCase
{
    /** @test */
    public function it_throws_exception_on_failed_validation()
    {
        $class = new class() {
            use ValidatesData;

            public function test(array $fields, Collection $collection): void
            {
                $this->validate($fields, $collection);
            }
        };

        $this->expectException(InvalidProviderDataException::class);

        $class->test(['field'], Collection::make());
    }

    /** @test */
    public function it_continues_flow_on_passed_validation()
    {
        $class = new class() {
            use ValidatesData;

            public function test(array $fields, Collection $collection): void
            {
                $this->validate($fields, $collection);
            }
        };

        $class->test(['field'], Collection::make(['field' => 1]));

        $this->assertTrue(true);
    }
}
