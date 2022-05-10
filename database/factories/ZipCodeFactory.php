<?php

namespace Database\Factories;

use App\Models\ZipCode;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method Collection|ZipCode create($attributes = [], ?Model $parent = null)
 * @method Collection|ZipCode make($attributes = [], ?Model $parent = null)
 */
class ZipCodeFactory extends Factory
{
    public function definition()
    {
        return [
            'zip_code'            => $this->faker->unique()->postcode,
            'locality'            => $this->faker->word,
            'federal_entity_key'  => rand(1, 9),
            'federal_entity_name' => $this->faker->word,
            'municipality_key'    => rand(1, 9),
            'municipality_name'   => $this->faker->word,
        ];
    }
}
