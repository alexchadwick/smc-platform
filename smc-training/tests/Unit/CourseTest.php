<?php

namespace Training\Api\Tests\Unit;

use Training\Api\Database\Seeders\CourseTypeSeeder;
use Training\Api\Models\Course;
use Training\Api\Models\CourseAttempt;
use Training\Api\Tests\Models\Author;
use Training\Api\Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;

class CourseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function course()
    {
        $model = Course::factory()->create();
        $this->assertEquals(Course::count(), 1);
    }

    /** @test */
    function course_attempts_relation()
    {
        $user = Author::create(
            ['name' => "John Doe"]
        );
        $userTwo = Author::create(
            ['name' => "John Doe"]
        );
        $course = Course::factory()->make()->create([
            'name' => 'Sample Course',
            //'slug' => 'sample-quiz',
        ]);

        $attempt = CourseAttempt::create([
            'course_id' => $course->id,
            'participant_id' => $user->id,
            'participant_type' => get_class($user),
        ]);
        $attemptTwo = CourseAttempt::create([
            'course_id' => $course->id,
            'participant_id' => $userTwo->id,
            'participant_type' => get_class($userTwo),
        ]);
        $this->assertEquals(1, $user->course_attempts()->count());
        $this->assertEquals($user->id, $attempt->participant->id);
        $this->assertEquals(2, $course->attempts()->count());
    }

    /** @test */
    function testCourseTypeSeeding()
    {
        $this->seed(CourseTypeSeeder::class);
        $this->assertDatabaseCount(config('smc-training.table_names.course_types'), 3);
    }
}
