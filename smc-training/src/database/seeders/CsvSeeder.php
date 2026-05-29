<?php

namespace Training\Api\Database\Seeders;

use Illuminate\Database\Seeder;
use Quiz\Api\Models\Question;
use Quiz\Api\Models\QuestionOption;
use Quiz\Api\Models\QuestionType;
use Quiz\Api\Models\Quiz;
use Quiz\Api\Models\QuizQuestion;
use Training\Api\Models\Course;
use Training\Api\Models\Courseable;
use Training\Api\Models\CourseQuiz;

class CsvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        echo PHP_EOL . 'Running CsvSeeder...' . PHP_EOL;

        //..
        $file = fopen(__DIR__."/./data/quizzes.csv","r");
        $quizzes_data = [];
        $row = 0;
        /**
         * 0.id
         * 1.name
         * 2.description
         */
        if (($handle = $file) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $row++;
                //skip first
                if($row === 1){
                    //return;
                    //return;
                } else {
                    $quiz = Quiz::create([
                        'name' => $data[1],
                        'pass_marks' => 0,
                        'slug' => $data[1],
                        'description' => $data[0] . '|' .$data[2],
                    ]);

                    $course = Course::create([
                        'name' => $data[1],
                        'description' => $data[2],
                    ]);

                    $courseQuiz = CourseQuiz::create([
                        'quiz_id' => $quiz->id,
                    ]);

                    $courseable = Courseable::create([
                        'course_id' => $course->id,
                        'courseable_id' => $courseQuiz->id,
                        'courseable_type' => get_class($courseQuiz),

                    ]);

                    //Add to array
                    $quizzes_data[$data[0]] = $quiz;
                }


            }
            fclose($handle);
        }

        echo PHP_EOL . 'SEEDED Quizzes:'. count($quizzes_data) . PHP_EOL;

        //..
        $file = fopen(__DIR__."/./data/quiz_questions.csv","r");
        $quiz_questions_data = [];
        $row = 0;
        /**
         * 0.id
         * 1.name
         * 2.description
         */
        if (($handle = $file) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $row++;
                //skip first
                if($row === 1){
                    //return ;
                } else {
                    $questionType = QuestionType::where('name','multiple_choice_single_answer')->firstOrFail();
                    $question = Question::create([
                        'name' => $data[2],
                        'question_type_id' => $questionType->id,
                        'is_active' => true
                    ]);
                    //Add to quiz
                    $quizQuestion = QuizQuestion::create([
                        'quiz_id' => $quizzes_data[$data[1]]->id,
                        'question_id' => $question->id,

                        'marks' => 1,
                        'negative_marks' => 0,
                        'is_optional' => 0,
                    ]);

                    //Add to array
                    $quiz_questions_data[$data[0]] = $quizQuestion;
                }

            }
            fclose($handle);
        }

        echo PHP_EOL . 'SEEDED QuizQuestions:'. count($quiz_questions_data) . PHP_EOL;

        //..
        $file = fopen(__DIR__."/./data/quiz_question_options.csv","r");
        $quiz_question_option_data = [];
        $row = 0;
        /**
         * id,question_id,name,is_correct
         * 0.id
         * 1.question_id
         * 2.name
         * 3.is_correct
         */
        if (($handle = $file) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $row++;
                //skip first
                if($row === 1){
                    //return ;
                } else {
                    //Add QuestionOption to Question
                    $quizQuestionOption = QuestionOption::create([
                        'question_id' => $quiz_questions_data[$data[1]]->question->id,
                        'name' => $data[2],
                        'is_correct' => (bool) $data[3] ?? false,
                    ]);

                    //Add to array
                    $quiz_question_option_data[$data[0]] = $quizQuestionOption;
                }

            }
            fclose($handle);
        }


        echo PHP_EOL . 'SEEDED QuizQuestionOptions:'. count($quiz_question_option_data) . PHP_EOL;

        //loop thru all quizzes an set new pass marks for 100% all options




        //$count = array_count_values(array_column($quizzes_data, 'userId'))[$userId]

        foreach ($quizzes_data as $key => $quiz) {
            $data = $quiz->withCount('questions')->first();
            $quiz->pass_marks = $data->questions_count;
            $quiz->save();
        }

        echo PHP_EOL . 'Updated Quizzes:'. count($quizzes_data) . PHP_EOL;


    }
}