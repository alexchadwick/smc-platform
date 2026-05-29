<?php

namespace Admin\Api\Tests\Unit;

use Admin\Api\Models\User;
use Admin\Api\Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function user()
    {
        $model = User::factory()->create();
        $this->assertEquals(User::count(), 1);
    }
    
}
