<?php

namespace Training\Api\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Training\Api\Models\Course;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition()
    {

        return [
            'name' => $this->faker->words(4, true),
            'description' => $this->faker->words(8, true),
            //'is_active' => $this->faker->numberBetween(0, 1),
        ];
    }
}
