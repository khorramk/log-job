<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class JobFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Job::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'summary' => $this->faker->sentence(3),
            'description' => $this->faker->sentence(2),
            'status' => $this->faker->randomElement(['open', 'in progress', 'completed', 'cancelled']),
        ];
    }
}
