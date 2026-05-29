<?php

namespace Quiz\Api\Database\Factories;

use Quiz\Api\Models\Question;
use Quiz\Api\Models\QuestionType;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition()
    {
        $question_type = QuestionType::create(
            [
                'name' => 'fill_the_blank',
            ]
        );
        return [
            'name' => $this->faker->words(4, true),
            //'name' => 'test question',
            'question_type_id' => $question_type->id,
            'media_url' => $this->faker->url,
            'is_active' => $this->faker->numberBetween(0, 1),
            'media_type' => 'image',
        ];
    }
}
