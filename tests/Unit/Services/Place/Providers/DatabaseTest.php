<?php

namespace Tests\Unit\Services\Place\Providers;

use App\Services\Place\Providers\Database;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\TestCase;

class DatabaseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_throws_not_found_exception_on_invalid_zip_code()
    {
        $this->expectException(NotFoundHttpException::class);

        $provider = new Database();
        $provider->findZipCode('');
    }
}
