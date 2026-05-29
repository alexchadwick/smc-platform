<?php

namespace SMC\ERP\Api\Database\Factories;

use SMC\ERP\Api\Models\Organization\OrganizationType;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationTypeFactory extends Factory
{
    protected $model = OrganizationType::class;

    public function definition()
    {
        return [
            'name' => $this->faker->words(4, true),
            'description' => $this->faker->words(10, true)
        ];
    }
}
