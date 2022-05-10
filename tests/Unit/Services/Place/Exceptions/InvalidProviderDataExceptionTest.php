<?php

namespace Tests\Unit\Services\Place\Exceptions;

use App\Services\Place\Exceptions\InvalidProviderDataException;
use Tests\TestCase;

class InvalidProviderDataExceptionTest extends TestCase
{
    /** @test */
    public function it_has_the_right_message()
    {
        $exception = new InvalidProviderDataException();

        $this->assertSame($exception->getMessage(), 'Invalid provider data');
    }
}
