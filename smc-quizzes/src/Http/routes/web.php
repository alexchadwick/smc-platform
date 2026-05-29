<?php

use Quiz\Api\Models\QuizAttempt;
use Quiz\Api\Models\QuizAttemptAnswer;
use Quiz\Api\Tests\Models\Author;

Route::group(['middleware' => ['web',
    //'auth'
]], function () {
    Route::get('/quiz/{quizId}', function ($quizId) {
        return view('smc-quizzes::quiz')->with([
            'quiz' => \Quiz\Api\Models\Quiz::findOrFail($quizId),
            'pageDetails' => [
                'title' => 'Quiz'
            ]
        ]);
    })->name('quiz');

    Route::get('testing/quiz/{quizId}', function ($quizId) {
        return view('smc-quizzes::quiz')->with([
            'quiz' => \Quiz\Api\Models\Quiz::findOrFail($quizId),
            'pageDetails' => [
                'title' => 'Quiz'
            ]
        ]);
    })->name('testQuiz');

    Route::post('testing/quiz/{quizId}', function (\Illuminate\Http\Request $request, $quizId) {


        $quiz = \Quiz\Api\Models\Quiz::findOrFail($quizId);

        // Record Quiz Attempt & Answers
        //Save attempt
        $author = Author::findOrFail(1);
        $quizAttempt = QuizAttempt::create([
            'quiz_id' => $quiz->id,
            'participant_id' => $author->id,
            'participant_type' => get_class($author)
        ]);

        //Save answers
        if($request->has('quizQuestionAnswerInput[]')) {
            foreach ( $request->get('quizQuestionAnswerInput[]') as $key => $data) {
                $quizQuestion = \Quiz\Api\Models\QuizQuestion::findOrFail($key);
                if(is_array($data)){
                    foreach ($data as $item) {
                        $questionOption = \Quiz\Api\Models\QuestionOption::findOrFail($item);
                        QuizAttemptAnswer::create(
                            [
                                'quiz_attempt_id' => $quizAttempt->id,
                                'quiz_question_id' => $quizQuestion->id,
                                'question_option_id' => $questionOption->id,
                                //'answer' => \Quiz\Api\Models\QuestionOption::findOrFail($data)->name
                            ]
                        );
                    }
                } else {
                    $questionOption = \Quiz\Api\Models\QuestionOption::findOrFail($data);
                    $questionType = $questionOption->question->question_type;
                    if($questionType->name == 'multiple_choice_single_answer') {

                        //multiple_choice_single_answer
                        QuizAttemptAnswer::create(
                            [
                                'quiz_attempt_id' => $quizAttempt->id,
                                'quiz_question_id' => $quizQuestion->id,
                                'question_option_id' => $questionOption->id,
                                //'answer' => \Quiz\Api\Models\QuestionOption::findOrFail($data)->name
                            ]
                        );
                    }
                    if($questionType->name == 'multiple_choice_multiple_answer') {
                        //multiple_choice_multiple_answer
                        throw new Exception('invalid multiple_choice_multiple_answer');
                    }
                    if($questionType->name == 'fill_the_blank') {
                        //fill_the_blank
                        QuizAttemptAnswer::create(
                            [
                                'quiz_attempt_id' => $quizAttempt->id,
                                'quiz_question_id' => $key,
                                'question_option_id' => $data,
                                'answer' => \Quiz\Api\Models\QuestionOption::findOrFail($data)->name
                            ]
                        );
                    }

                }

            }

        }

        return json_encode(
            [
                'quiz' => $quiz,
                'quizAttempt' => $quizAttempt,
                'quizAttemptAnswers' => $quizAttempt->answers,
                'quizAttemptAnswerCount' => $quizAttempt->answers()->count(),
                'quizAttemptScore' => $quizAttempt->calculate_score(),
                'validate' => $quizAttempt->validate(),
            ]
        , JSON_PRETTY_PRINT);
    })->name('testSubmitQuiz');
});
