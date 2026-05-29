<?php

namespace SMC\ERP\Api\Database\Factories;

use SMC\ERP\Api\Models\Organization\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;
use SMC\ERP\Api\Models\Organization\OrganizationType;

class OrganizationFactory extends Factory
{
    protected $model = Organization::class;

    public function definition()
    {
        $type = OrganizationType::create(
            [
                'name' => 'customer',
            ]
        );
        return [
            'name' => $this->faker->words(4, true),
            'description' => $this->faker->words(10, true),
            'organization_type_id' => $type,
        ];
    }
}
