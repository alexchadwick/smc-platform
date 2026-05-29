<?php

namespace Training\Api\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Training\Api\Models\CourseType;

class CourseTypeFactory extends Factory
{
    protected $model = CourseType::class;

    public function definition()
    {

        return [
            'name' => $this->faker->words(4, true),
        ];
    }
}
