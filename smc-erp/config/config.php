<?php

return [

    /*
    |--------------------------------------------------------------------------
    | API
    |--------------------------------------------------------------------------
    |
    | API Settings
    |
    */
    'api_prefix' => 'api/v1',

    /*
    |--------------------------------------------------------------------------
    | Table Names on Database
    |--------------------------------------------------------------------------
    |
    | Enter the names of the tables.
    |
    */

    'table_names' => [
        'organizations'               => 'organizations',
        'organizations_types'         => 'organizations_types',
        'organization_divisions'      => 'organization_divisions',

    ],

    /*
    |--------------------------------------------------------------------------
    | Models Name
    |--------------------------------------------------------------------------
    |
    | Allow to override Quiz table to extend code
    |
    */

    'models' => [

        /*
         * Default Quiz\Api\Models\Question::class
         */

        'organization' => SMC\ERP\Api\Models\Organization\Organization::class,
        'organization_type' => SMC\ERP\Api\Models\Organization\OrganizationType::class,
        'organization_divisions' => SMC\ERP\Api\Models\Organization\OrganizationDivision::class,


    ],

    'organization_types' => [
        'customer' => ['name'=>'customer','description'=>'Customer Type'],
        'vendor' => ['name'=>'vendor','description'=>'Vendor Type'],
    ]

];
