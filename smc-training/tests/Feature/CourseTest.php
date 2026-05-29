<?php

namespace Training\Api\Tests\Feature;

use Training\Api\Tests\Models\Author;
use Training\Api\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourseTest extends TestCase
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


    function course_type_1()
    {

        $course =  Course::factory()->create([
            //..
        ]);

        $this->assertEquals(3, $quiz->questions->count());
        $this->assertEquals(10, $quiz->questions->sum('marks'));

        // Participants
        $participant_one = Author::create([
            'name' => 'Bravo'
        ]);



    }
}
