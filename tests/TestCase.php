<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Illuminate\Testing\TestResponse;
use Opis\JsonSchema\Errors\ErrorFormatter;
use Opis\JsonSchema\Validator;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function assertValidSchema(array $expected, $actual, string $message = ''): void
    {
        $validator = new Validator();

        $result = $validator->validate($actual, json_encode($expected));

        if ($result->hasError()) {
            $formatter = new ErrorFormatter();
            $message   = implode("\n", $formatter->formatFlat($result->error()));
        }

        $this->assertTrue($result->isValid(), $message);
    }

    public function validateResponseSchema(array $schema, TestResponse $response)
    {
        $this->assertJson($response->content());
        $this->assertValidSchema($schema, json_decode($response->content()));
    }

    public function assertHasExpectedColumns(string $tableName, array $expectedColumns): void
    {
        $missing = array_diff($expectedColumns, Schema::getColumnListing($tableName));

        $this->assertTrue(Schema::hasColumns($tableName, $expectedColumns),
            "Columns missing in table {$tableName}: " . implode(', ', $missing));

        $diff = array_diff(Schema::getColumnListing($tableName), $expectedColumns);

        $this->assertCount(0, $diff, "Columns mismatch in table {$tableName}: " . implode(', ', $diff));
    }

    protected function assertCorrectRelation(Collection $related, string $class, int $count): void
    {
        $this->assertCount($count, $related, "{$class} instances expected");

        if (!$related->isEmpty()) {
            $this->assertCollectionOfClass($class, $related);
        }
    }

    public function assertCollectionOfClass(string $expected, Collection $collection, string $message = ''): void
    {
        $this->assertTrue(class_exists($expected), "Class {$expected} doesn't exist.");

        $message = $message ?: "Failed asserting that all elements in the collection are instances of {$expected}";

        $this->assertCount($collection->count(), $collection->whereInstanceOf($expected), $message);
    }
}
