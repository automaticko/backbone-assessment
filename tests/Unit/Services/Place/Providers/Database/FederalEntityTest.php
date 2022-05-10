<?php

namespace Tests\Unit\Services\Place\Providers\Database;

use App\Services\Place\Exceptions\InvalidProviderDataException;
use App\Services\Place\Providers\Database\FederalEntity;
use Illuminate\Support\Collection;
use Tests\TestCase;

class FederalEntityTest extends TestCase
{
    private int    $key  = 1;
    private string $name = 'name';
    private string $code = 'code';

    /** @test */
    public function it_throws_exception_trying_to_instance_with_invalid_data()
    {
        $this->expectException(InvalidProviderDataException::class);

        new FederalEntity(Collection::make());
    }

    /**
     * @test
     * @throws InvalidProviderDataException
     */
    public function it_returns_key()
    {
        $instance = new FederalEntity($this->validData());

        $this->assertSame($this->key, $instance->key());
    }

    /**
     * @test
     * @throws InvalidProviderDataException
     */
    public function it_returns_name()
    {
        $instance = new FederalEntity($this->validData());

        $this->assertSame($this->name, $instance->name());
    }

    /**
     * @test
     * @throws InvalidProviderDataException
     */
    public function it_returns_code()
    {
        $instance = new FederalEntity($this->validData());

        $this->assertSame($this->code, $instance->code());
    }

    private function validData(): Collection
    {
        return Collection::make([
            'federal_entity_key'  => $this->key,
            'federal_entity_name' => $this->name,
            'federal_entity_code' => $this->code,
        ]);
    }
}
