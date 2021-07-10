<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {  
        return [            
            'name' => $this->faker->unique()->sentence(1),
            'description' => $this->faker->text, //realText,
            'category_id' => $this->faker->randomElement(Category::all()->pluck('id')->toArray())
        ];
    }
}
