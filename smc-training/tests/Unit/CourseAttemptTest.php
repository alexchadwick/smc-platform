<?php

namespace Training\Api\Tests\Unit;

use Training\Api\Tests\Models\Author;
use Training\Api\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Training\Api\Models\Course;
use Training\Api\Models\CourseAttempt;
use Training\Api\Models\CourseType;

class CourseAttemptTest extends TestCase
{
    use RefreshDatabase;

    public function init($courseType = 1)
    {
        $user = Author::create(
            ['name' => "John Doe"]
        );

        //Course Types
        CourseType::insert(
            [
                [
                    'name' => 'pdf_document',
                ],
                [
                    'name' => 'video',
                ],
                [
                    'name' => 'quiz',
                ]
            ]
        );

        $course = Course::create(['name' => 'Sample Course']);
        $courseAttempt = CourseAttempt::create([
            'course_id' => $course->id,
            'participant_id' => $user->id,
            'participant_type' => get_class($user),
        ]);
        return [$user, $course, $courseAttempt];
    }


}
