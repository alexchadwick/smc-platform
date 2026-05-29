<?php

namespace SMC\ERP\Api\Database\Seeders;

use SMC\ERP\Api\Models\Organization\OrganizationType;
use Illuminate\Database\Seeder;

class OrganizationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = config('smc-erp.organization_types');
        foreach ($items as $key => $i) {
            OrganizationType::updateOrCreate([
                'name' => $i['name'],
                'description' => $i['description'],
            ]);
        }
    }
}