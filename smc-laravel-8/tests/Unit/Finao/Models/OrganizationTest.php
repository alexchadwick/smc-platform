<?php

namespace Tests\Unit\Finao\Models;

use Faker\Factory;
use Finao\Order\Api\Http\Resources\OrderFormResource;
use Finao\Order\Api\Http\Resources\OrderFormResource as ResourceClass;
use Finao\Order\Api\Models\Address;
use Finao\Order\Api\Models\OrderForm;
use Finao\Order\Api\Models\Organization;
use Finao\Order\Api\Models\ProductItem;
use Finao\Order\Api\Models\ProductOptionGroup;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;
use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;

class OrganizationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }


}
