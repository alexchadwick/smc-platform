<?php

namespace Quiz\Api\Database\Factories;

use Quiz\Api\Models\QuestionType;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionTypeFactory extends Factory
{
    protected $model = QuestionType::class;

    public function definition()
    {
        return [
            'name' => $this->faker->words(1, true)
        ];
    }
}
