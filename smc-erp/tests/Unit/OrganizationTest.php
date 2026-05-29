<?php

namespace SMC\ERP\Api\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use ERP\Api\Database\Seeders\OrganizationTypeSeeder;
use ERP\Api\Models\Organization\Organization;
use ERP\Api\Models\Organization\OrganizationType;
use SMC\ERP\Api\Tests\TestCase;

class OrganizationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function testModel()
    {
        $types = config('smc-erp.table_names.organization_types');
        $model = Organization::factory()
            ->for(OrganizationType::factory()->state([
                'name' => $types['customer']['name'],
                'description' => $types['customer']['description'],
            ]))
            ->create();
        $this->assertEquals(Organization::count(), 1);
    }


    /** @test */
    function testOrganizationTypeSeeding()
    {
        $this->seed(OrganizationTypeSeeder::class);
        $this->assertDatabaseCount(config('smc-erp.table_names.organization_types'), count(config('smc-erp.organization_types')));
    }
}
