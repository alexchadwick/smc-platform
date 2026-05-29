<?php

namespace Quiz\Api\Tests\Unit;

use Quiz\Api\Models\Topic;
use Quiz\Api\Tests\TestCase;
use Quiz\Api\Models\Question;
use Quiz\Api\Models\QuestionType;
use Quiz\Api\Models\QuestionOption;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Quiz\Api\Database\Seeders\QuestionTypeSeeder;

class QuestionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function question()
    {
        $question = Question::factory()->create();
        $this->assertEquals(Question::count(), 1);
    }

    /** @test */
    function question_question_type_relation()
    {
        $questionType = QuestionType::factory()->create([
            'name' => 'fill_the_blank'
        ]);
        $questionType->questions()->saveMany([
            Question::factory()->make(),
            Question::factory()->make()
        ]);
        $this->assertEquals($questionType->questions->count(), 2);
    }

    /** @test */
    function question_and_topics_relation()
    {
        $topic1 = Topic::factory()->create(['topic' => 'Test Topic One']);
        $topic2 = Topic::factory()->create(['topic' => 'Test Topic Two']);
        $question = Question::factory()->create();
        $question->topics()->attach($topic1);
        $question->topics()->attach($topic2);
        $this->assertEquals(2, $question->topics->count());
    }

    /** @test */
    function question_and_question_options_relation()
    {
        $question = Question::factory()->create();
        $question->options()->saveMany([
            QuestionOption::factory()->make([
                'question_id' => $question->id,
            ]),
            QuestionOption::factory()->make([
                'question_id' => $question->id,
            ]),
        ]);
        $this->assertEquals(2, $question->options->count());
    }

    /** @test */
    function testQuestionTypeSeeding()
    {
        $this->seed(QuestionTypeSeeder::class);
        $this->assertDatabaseCount(config('smc-quizzes.table_names.question_types'), 3);
    }
}
