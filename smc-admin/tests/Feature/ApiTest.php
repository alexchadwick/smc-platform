<?php

namespace Admin\Api\Tests\Feature;

use Admin\Api\Http\Controllers\BaseApiController;
use Admin\Api\Tests\Models\User;
use Admin\Api\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    function security()
    {
        //Test 1 - should fail, unauth
        $response = $this->getJson($this->apiHost);
        $response
            ->assertStatus(401);

        //Sign in
        $this->setActingAs(['*']);

        //Test 3
        $response = $this->getJson($this->apiHost);
        $response
            ->assertStatus(200)
            ->assertSee('API');
    }

    /** @test */
    function root()
    {
        $this->setActingAs(['*']);
        //Test 1
        $response = $this->getJson($this->apiHost);
        $response
            ->assertStatus(200)
            ->assertSee('API');
    }

    //## /users

    /** @test */
    function users_index()
    {
        $this->setActingAs(['*']);

        //Test 1
        $response = $this->getJson($this->apiHost.'/users');
        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [],
            ]);

        //Test 2 - Test pagination, make sure pagination is limited at default
        $model = User::factory()->create();
        $model2 = User::factory()->create();
        $response = $this->getJson($this->apiHost.'/users');
        $controller = new BaseApiController();
        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [],
                'meta' => [
                    'total' => 3, //tory: it created 3, not 2 bc of the actingAs
                    'per_page' => $controller->defaultPaginateLimit
                ],
            ]);

        //Test 3 - Paginate limit 1 per page
        $response3 = $this->getJson($this->apiHost.'/users?paginate=true&limit=1');
        $response3
            ->assertStatus(200)
            ->assertJson([
                'data' => [],
                'meta' => [
                    'total' => 3,
                    'per_page' => 1
                ],
            ]);

        //Test 4 - Disable Pagination
        $response3 = $this->getJson($this->apiHost.'/users?paginate=false&limit=1');
        $response3
            ->assertStatus(200)
            ->assertJson(['data' => []])
            ->assertJsonMissing(['meta' => []]);

    }

    /** @test */
    function users_store()
    {
        $this->setActingAs(['*']);

        //Test 1 - should fail, test validator
        $response = $this->postJson($this->apiHost.'/users', []);
        $response
            ->assertStatus(422)
            ->assertJson(['errors' => [],]);

        //Test 2
        $response2 = $this->postJson($this->apiHost.'/users', ['name' => 'Sample','email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password'

        ]);
        $response2
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'name' => 'Sample'
                ],
            ]);

    }

    /** @test */
    function users_show()
    {
        $this->setActingAs(['*']);

        //Test 1 - Should fail
        $response = $this->getJson($this->apiHost.'/users/null');
        $response
            ->assertStatus(404);

        //Test 2 - Should work
        $user = User::factory()->create();
        $response2 = $this->getJson($this->apiHost.'/users/' . $user->id);
        $response2
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $user->id
                ]
            ]);

    }

    /** @test */
    function users_update()
    {
        $this->setActingAs(['*']);

        //Test 1 - Should fail
        $response = $this->putJson($this->apiHost.'/users/null');
        $response
            ->assertStatus(404);

        //Test 2 - Should work
        $user = User::factory()->create();
        $data = $user->toArray();
        $data['name'] = 'Sample Test 003';
        $response2 = $this->putJson($this->apiHost.'/users/' . $user->id, $data);
        $response2
            ->assertStatus(200) ->assertJson(['data' => [
                'id' => $user->id,
                'name' => 'Sample Test 003',
            ]]);

        //Test 3 - Should work
        $user = User::factory()->create();
        $data = $user->toArray();
        $data['name'] = 'Sample Test 113';
        $response3 = $this->putJson($this->apiHost.'/users/' . $user->id, $data);
        $response3
            ->assertStatus(200)
            ->assertJson(['data' => [
                'id' => $user->id,
                'name' => 'Sample Test 113',
            ]]);

    }

    /** @test */
    function users_destroy()
    {
        $this->setActingAs(['*']);

        //Test 1 - Should fail
        $response = $this->deleteJson($this->apiHost.'/users/23423');
        $response
            ->assertStatus(404);

        //Test 2 - Should work
        $user = User::factory()->create();
        $response2 = $this->deleteJson($this->apiHost.'/users/' . $user->id);
        $response2
            ->assertStatus(204);

    }

    /** @test */
    function users_restore()
    {
        $this->setActingAs(['*']);

        //Test 1 - Should fail
        $response = $this->putJson($this->apiHost.'/users/null/restore', [
            //..
        ]);
        $response
            ->assertStatus(404);

        //Test 2
        $user = User::factory()->create();
        $id = $user->id;
        $response3 = $this->deleteJson($this->apiHost.'/users/' . $id, []);
        $response3
            ->assertStatus(204);
        $response11 = $this->putJson($this->apiHost.'/users/' . $id . '/restore', []);
        $response11
            ->assertStatus(200);

        //Test 3
        $user = User::factory()->create();
        $user->delete();
        $response4 = $this->putJson($this->apiHost.'/users/' . $user->id . '/restore', []);
        $response4
            ->assertStatus(200);
    }


}
