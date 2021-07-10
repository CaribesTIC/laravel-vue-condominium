<?php

namespace Database\Factories;

use App\Models\Journal;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{
    User,
    Task,
    Zone
};

class JournalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Journal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now'),
            'user_id' => $this->faker->randomElement(User::all()->pluck('id')->toArray()),
            'task_id' => $this->faker->randomElement(Task::all()->pluck('id')->toArray()),
            'zone_id' => $this->faker->randomElement(Zone::all()->pluck('id')->toArray()),
            'input' => $this->faker->time($format = 'H:i', $max = 'now'),
            'output' => $this->faker->time($format = 'H:i', $max = 'now')
        ];
    }
}
