<?php

namespace Tests\Unit\Services\Place\Providers\Backbone;

use App\Services\Place\Exceptions\InvalidProviderDataException;
use App\Services\Place\Providers\Backbone\Municipality;
use Illuminate\Support\Collection;
use Tests\TestCase;

class MunicipalityTest extends TestCase
{
    private int    $key  = 1;
    private string $name = 'name';

    /** @test */
    public function it_throws_exception_trying_to_instance_with_invalid_data()
    {
        $this->expectException(InvalidProviderDataException::class);

        new Municipality(Collection::make());
    }

    /**
     * @test
     * @throws InvalidProviderDataException
     */
    public function it_returns_key()
    {
        $instance = new Municipality($this->validData());

        $this->assertSame($this->key, $instance->key());
    }

    /**
     * @test
     * @throws InvalidProviderDataException
     */
    public function it_returns_name()
    {
        $instance = new Municipality($this->validData());

        $this->assertSame($this->name, $instance->name());
    }

    private function validData(): Collection
    {
        return Collection::make([
            'key'  => $this->key,
            'name' => $this->name,
        ]);
    }
}
