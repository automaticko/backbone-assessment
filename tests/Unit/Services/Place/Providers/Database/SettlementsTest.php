<?php

namespace Tests\Unit\Services\Place\Providers\Database;

use App\Services\Place\Exceptions\InvalidProviderDataException;
use App\Services\Place\Providers\Database\Settlement;
use App\Services\Place\Providers\Database\Settlements;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Mockery;
use Tests\TestCase;

class SettlementsTest extends TestCase
{
    /**
     * @test
     * @dataProvider invalidDataProvider
     */
    public function it_throws_exception_trying_to_instance_with_empty_collection(Collection $data)
    {
        $this->expectException(InvalidProviderDataException::class);

        new Settlements($data);
    }

    public function invalidDataProvider(): array
    {
        return [
            [Collection::make()],
            [Collection::make([Collection::make(['invalid'])])],
        ];
    }

    /**
     * @test
     * @throws InvalidProviderDataException
     */
    public function it_returns_items()
    {
        $settlement = Mockery::mock(Settlement::class);
        App::bind(Settlement::class, fn() => $settlement);

        $data = Collection::make([
            Collection::make([
                'key'  => 1,
                'name' => '',
                'zone' => '',
                'type' => Collection::make(['type' => '']),
            ]),
        ]);

        $instance = new Settlements($data);

        $this->assertEquals(Collection::make([$settlement]), $instance->items());
    }
}
