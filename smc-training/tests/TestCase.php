<?php

namespace Training\Api\Tests;

use Training\Api\Tests\Models\User;
use Laravel\Passport\Passport;
use Laravel\Passport\PassportServiceProvider;
use Laravel\Sanctum\Sanctum;
use Laravel\Sanctum\SanctumServiceProvider;
use Training\TrainingServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{

    protected $apiHost = null;

    public function setUp(): void
    {
        parent::setUp();
        // additional setup
    }

    protected function getPackageProviders($app)
    {
        return [
            TrainingServiceProvider::class,
            PassportServiceProvider::class,
            SanctumServiceProvider::class,
        ];
    }

    /**
     * set ActingAs function
     *
     * @param array $scope
     * @param $options
     * @param $model
     * @param $override
     * @return void
     * @throws \Exception
     */
    public function setActingAs(array $scope = [], $options = null, $model = User::class, $override = null) {
        $authPackage = env('AUTH_PACKAGE', 'sanctum');
        switch ($authPackage) {
            case "sanctum":
                Sanctum::actingAs(
                    User::factory()->create(),
                    //$override ?? $model::factory()->create(),
                    $scope
                );
                break;
            case "passport":
                Passport::actingAs(
                    $override ?? $model::factory()->create(),
                    $scope
                );
                break;
            default:
                throw new \Exception('Error: auth package');
        }
    }

    protected function getEnvironmentSetUp($app)
    {
        $this->apiHost = config('smc-training.api_prefix', 'api/v1');

        $authPackage = env('AUTH_PACKAGE', 'sanctum');
        switch ($authPackage) {
            case "sanctum":
                $app->make('Illuminate\Contracts\Http\Kernel')
                    ->prependMiddlewareToGroup('api',\Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class);
                break;
            case "passport":

                break;
            default:
                throw new \Exception('Error: auth package');
        }

        //Add API GUARD
        $app['config']->set('auth.guards.api', [
            'driver' => strtolower($authPackage),
            'provider' => 'users',
        ]);

        // perform environment setup
        // import the CreatePostsTable class from the migration
        // include_once __DIR__ . '/../database/migrations/2021_05_22_053359_create_quizzes_table.php';
        include_once __DIR__ . '/migrations/create_authors_table.php';
        include_once __DIR__ . '/migrations/create_users_table.php';
        // run the up() method of that migration class
        // (new \CreateQuizzesTable)->up();
        (new \CreateAuthorsTable)->up();
        (new \CreateUsersTable)->up();
    }
}
