<?php

namespace Tests\Unit\Services\Place\Providers\Backbone;

use App\Services\Place\Exceptions\InvalidProviderDataException;
use App\Services\Place\Providers\Backbone\SettlementType;
use Illuminate\Support\Collection;
use Tests\TestCase;

class SettlementTypeTest extends TestCase
{
    /** @test */
    public function it_throws_exception_trying_to_instance_with_invalid_data()
    {
        $this->expectException(InvalidProviderDataException::class);

        new SettlementType(Collection::make());
    }

    /**
     * @test
     * @throws InvalidProviderDataException
     */
    public function it_returns_name()
    {
        $data = Collection::make([
            'name' => $name = 'name',
        ]);

        $instance = new SettlementType($data);

        $this->assertSame($name, $instance->name());
    }
}
