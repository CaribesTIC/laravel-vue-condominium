<?php

namespace Database\Factories;

use App\Models\DwellingType;
use Illuminate\Database\Eloquent\Factories\Factory;

class DwellingTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DwellingType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->sentence(1),
            'is_active' => $this->faker->boolean(1)
        ];
    }
}
