<?php

namespace SMC\ERP\Api\Database\Seeders;

use SMC\ERP\Api\Models\Organization\Organization;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
          /*  [
                'name' => '',
                'description' => '',
                'is_active' => true,
            ],*/
        ];
        foreach ($items as $i) {
            Organization::create($i);
        }
    }
}