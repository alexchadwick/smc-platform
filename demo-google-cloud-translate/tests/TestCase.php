<?php

namespace Training\Api\Tests;

use Training\Api\Tests\Models\User;
use Laravel\Passport\Passport;
use Laravel\Passport\PassportServiceProvider;
use Laravel\Sanctum\Sanctum;
use Laravel\Sanctum\SanctumServiceProvider;
use Training\TrainingServiceProvider;

class TestCase extends \PHPUnit\Framework\TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        // additional setup
    }


}
