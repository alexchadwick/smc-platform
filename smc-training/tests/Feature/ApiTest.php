<?php

namespace Training\Api\Tests\Feature;

use Training\Api\Http\Controllers\BaseApiController;
use Training\Api\Models\Course;
use Training\Api\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    /*/
    function quiz_multiple_choice_single_answer_all_correct_answers()
    {

        $quiz_question_three =  QuizQuestion::factory()->create([
            'quiz_id' => $quiz->id,
            'question_id' => $question_three->id,
            'marks' => 4,
            'order' => 2,
            'negative_marks' => 2,
        ]);

        $this->assertEquals(3, $quiz->questions->count());
        $this->assertEquals(10, $quiz->questions->sum('marks'));

        // Participants
        $participant_one = Author::create([
            'name' => 'Bravo'
        ]);

    }*/

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

    //## /courses

    /** @test */
    function courses_index()
    {
        $this->setActingAs(['*']);

        //Test 1
        $response = $this->getJson($this->apiHost.'/courses');
        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [],
            ]);

        //Test 2 - Test pagination, make sure pagination is limited at default
        $model = Course::factory()->create();
        $model2 = Course::factory()->create();
        $response = $this->getJson($this->apiHost.'/courses');
        $controller = new BaseApiController();
        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [],
                'meta' => [
                    'total' => 2,
                    'per_page' => $controller->defaultPaginateLimit
                ],
            ]);

        //Test 3 - Paginate limit 1 per page
        $response3 = $this->getJson($this->apiHost.'/courses?paginate=true&limit=1');
        $response3
            ->assertStatus(200)
            ->assertJson([
                'data' => [],
                'meta' => [
                    'total' => 2,
                    'per_page' => 1
                ],
            ]);

        //Test 4 - Disable Pagination
        $response3 = $this->getJson($this->apiHost.'/courses?paginate=false&limit=1');
        $response3
            ->assertStatus(200)
            ->assertJson(['data' => []])
            ->assertJsonMissing(['meta' => []]);

    }

    /** @test */
    function courses_store()
    {
        $this->setActingAs(['*']);

        //Test 1 - should fail, test validator
        $response = $this->postJson($this->apiHost.'/courses', []);
        $response
            ->assertStatus(422)
            ->assertJson(['errors' => [],]);

        //Test 2
        $response2 = $this->postJson($this->apiHost.'/courses', ['name' => 'Sample']);
        $response2
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'name' => 'Sample'
                ],
            ]);

    }

    /** @test */
    function courses_show()
    {
        $this->setActingAs(['*']);

        //Test 1 - Should fail
        $response = $this->getJson($this->apiHost.'/courses/null');
        $response
            ->assertStatus(404);

        //Test 2 - Should work
        $course = Course::factory()->create();
        $response2 = $this->getJson($this->apiHost.'/courses/' . $course->id);
        $response2
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $course->id
                ]
            ]);

    }

    /** @test */
    function courses_update()
    {
        $this->setActingAs(['*']);

        //Test 1 - Should fail
        $response = $this->putJson($this->apiHost.'/courses/null');
        $response
            ->assertStatus(404);

        //Test 2 - Should work
        $course = Course::factory()->create();
        $data = $course->toArray();
        $data['name'] = 'Sample Test 003';
        $response2 = $this->putJson($this->apiHost.'/courses/' . $course->id, $data);
        $response2
            ->assertStatus(200) ->assertJson(['data' => [
                'id' => $course->id,
                'name' => 'Sample Test 003',
            ]]);

        //Test 3 - Should work
        $course = Course::factory()->create();
        $data = $course->toArray();
        $data['name'] = 'Sample Test 113';
        $response3 = $this->putJson($this->apiHost.'/courses/' . $course->id, $data);
        $response3
            ->assertStatus(200)
            ->assertJson(['data' => [
                'id' => $course->id,
                'name' => 'Sample Test 113',
            ]]);

    }

    /** @test */
    function courses_destroy()
    {
        $this->setActingAs(['*']);

        //Test 1 - Should fail
        $response = $this->deleteJson($this->apiHost.'/courses/null');
        $response
            ->assertStatus(404);

        //Test 2 - Should work
        $course = Course::factory()->create();
        $response2 = $this->deleteJson($this->apiHost.'/courses/' . $course->id);
        $response2
            ->assertStatus(204);

    }

    /** @test */
    function courses_restore()
    {
        $this->setActingAs(['*']);

        //Test 1 - Should fail
        $response = $this->putJson($this->apiHost.'/courses/null/restore', [
            //..
        ]);
        $response
            ->assertStatus(404);

        //Test 2
        $course = Course::factory()->create();
        $id = $course->id;
        $response3 = $this->deleteJson($this->apiHost.'/courses/' . $id, []);
        $response3
            ->assertStatus(204);
        $response11 = $this->putJson($this->apiHost.'/courses/' . $id . '/restore', []);
        $response11
            ->assertStatus(200);

        //Test 3
        $course = Course::factory()->create();
        $course->delete();
        $response4 = $this->putJson($this->apiHost.'/courses/' . $course->id . '/restore', []);
        $response4
            ->assertStatus(200);
    }


}
