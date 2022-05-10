<?php

namespace Tests\Unit\Services\Place\Exceptions;

use App\Services\Place\Exceptions\InvalidProviderException;
use Tests\TestCase;

class InvalidProviderExceptionTest extends TestCase
{
    /** @test */
    public function it_has_the_right_message()
    {
        $exception = new InvalidProviderException();

        $this->assertSame($exception->getMessage(), 'Invalid provider');
    }
}
