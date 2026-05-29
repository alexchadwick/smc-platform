<?php

namespace Quiz\Api\Database\Factories;

use Illuminate\Support\Str;
use Quiz\Api\Models\Topic;
use Illuminate\Database\Eloquent\Factories\Factory;

class TopicFactory extends Factory
{
    protected $model = Topic::class;

    public function definition()
    {
        $name = $this->faker->words(4, true);
        //$name = 'test';
        return [
            'name' => $name,
            'slug' => Str::slug($name, '-'),
            'parent_id' => null,
            'is_active' => $this->faker->numberBetween(0, 1)
        ];
    }
}
