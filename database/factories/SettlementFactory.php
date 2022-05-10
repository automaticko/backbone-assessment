<?php

namespace Database\Factories;

use App\Models\Settlement;
use App\Models\ZipCode;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method Collection|Settlement create($attributes = [], ?Model $parent = null)
 * @method Collection|Settlement make($attributes = [], ?Model $parent = null)
 */
class SettlementFactory extends Factory
{
    public function definition()
    {
        return [
            'zip_code_id' => ZipCode::factory(),
            'key'         => rand(1, 9),
            'name'        => $this->faker->word,
            'zone'        => $this->faker->word,
            'type'        => $this->faker->word,
        ];
    }

    public function usingZipCode(ZipCode $zipCode): self
    {
        return $this->state(function() use ($zipCode) {
            return [
                'zip_code_id' => $zipCode->getKey(),
            ];
        });
    }
}
