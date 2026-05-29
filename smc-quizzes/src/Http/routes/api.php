<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['api','auth:api']], function () {

    Route::group(['prefix' => config('smc-quizzes.api_prefix', 'api/v1')], function () {

        Route::get('/',function (\Illuminate\Http\Request $request) {
            return
                'Quiz API';
        });

        //API RESOURCES



        //## Courses
        Route::get('user',function (Request $request){
            return $request->user();
        });
        Route::get('user/dashboard',function (Request $request){
            $user = $request->user();
            return [
                'available_courses' => $user->courses()->isNotCompleted()->get(),
                'completed_courses' => $user->courses()->isCompleted()->get(),
            ];
        });
        Route::get('courses', \Training\Api\Http\Controllers\QuizController::class . '@index');


        //## Topics
        Route::get('topics', \Quiz\Api\Api\Http\Controllers\TopicController::class . '@index');
        Route::post('topics', \Quiz\Api\Api\Http\Controllers\TopicController::class . '@create');
        Route::get('topics/{topic}', \Quiz\Api\Api\Http\Controllers\TopicController::class . '@show');
        Route::put('topics/{topic}', \Quiz\Api\Api\Http\Controllers\TopicController::class . '@show');
        Route::delete('topics/{topic}', \Quiz\Api\Api\Http\Controllers\TopicController::class . '@destroy');
        Route::put('topics/{topic}/restore', \Quiz\Api\Api\Http\Controllers\TopicController::class . '@restore');


        //## Quizzes
        Route::get('quizzes', \Quiz\Api\Api\Http\Controllers\QuizController::class . '@index');
        Route::post('quizzes', \Quiz\Api\Api\Http\Controllers\QuizController::class . '@create');
        Route::get('quizzes/{quiz}', \Quiz\Api\Api\Http\Controllers\QuizController::class . '@show');
        Route::put('quizzes/{quiz}', \Quiz\Api\Api\Http\Controllers\QuizController::class . '@show');
        Route::delete('quizzes/{quiz}', \Quiz\Api\Api\Http\Controllers\QuizController::class . '@destroy');
        Route::put('quizzes/{quiz}/restore', \Quiz\Api\Api\Http\Controllers\QuizController::class . '@restore');

        //## Quiz Question
        Route::get('quizzes/{quiz}/questions', \Quiz\Api\Api\Http\Controllers\QuizQuestionController::class . '@index');
        Route::post('quizzes/{quiz}/questions', \Quiz\Api\Api\Http\Controllers\QuizQuestionController::class . '@create');
        Route::get('quizzes/{quiz}/questions/{quizQuestion}', \Quiz\Api\Api\Http\Controllers\QuizQuestionController::class . '@show');
        Route::put('quizzes/{quiz}/questions/{quizQuestion}', \Quiz\Api\Api\Http\Controllers\QuizQuestionController::class . '@show');
        Route::delete('quizzes/{quiz}/questions/{quizQuestion}', \Quiz\Api\Api\Http\Controllers\QuizQuestionController::class . '@destroy');
        Route::put('quizzes/{quiz}/restore/questions/{quizQuestion}', \Quiz\Api\Api\Http\Controllers\QuizQuestionController::class . '@restore');

        //## Quiz Attempt
        Route::get('quizzes/{quiz}/attempts', \Quiz\Api\Api\Http\Controllers\QuizAttemptController::class . '@index');
        Route::post('quizzes/{quiz}/attempts', \Quiz\Api\Api\Http\Controllers\QuizAttemptController::class . '@create');
        Route::get('quizzes/{quiz}/attempts/{quizAttempt}', \Quiz\Api\Api\Http\Controllers\QuizAttemptController::class . '@show');
        Route::put('quizzes/{quiz}/attempts/{quizAttempt}', \Quiz\Api\Api\Http\Controllers\QuizAttemptController::class . '@show');
        Route::delete('quizzes/{quiz}/attempts/{quizAttempt}', \Quiz\Api\Api\Http\Controllers\QuizAttemptController::class . '@destroy');
        Route::put('quizzes/{quiz}/restore/attempts/{quizAttempt}', \Quiz\Api\Api\Http\Controllers\QuizAttemptController::class . '@restore');

        //## Quiz Attempt Answer
        Route::get('quizzes/{quiz}/attempts/{quizAttempt}/answers', \Quiz\Api\Api\Http\Controllers\QuizAttemptAnswerController::class . '@index');
        Route::post('quizzes/{quiz}/attempts/{quizAttempt}/answers', \Quiz\Api\Api\Http\Controllers\QuizAttemptAnswerController::class . '@create');
        Route::get('quizzes/{quiz}/attempts/{quizAttempt}/answers/{quizAttemptAnswer}', \Quiz\Api\Api\Http\Controllers\QuizAttemptAnswerController::class . '@show');
        Route::put('quizzes/{quiz}/attempts/{quizAttempt}/answers/{quizAttemptAnswer}', \Quiz\Api\Api\Http\Controllers\QuizAttemptAnswerController::class . '@show');
        Route::delete('quizzes/{quiz}/attempts/{quizAttempt}/answers/{quizAttemptAnswer}', \Quiz\Api\Api\Http\Controllers\QuizAttemptAnswerController::class . '@destroy');
        Route::put('quizzes/{quiz}/restore/attempts/{quizAttempt}/answers/{quizAttemptAnswer}', \Quiz\Api\Api\Http\Controllers\QuizAttemptAnswerController::class . '@restore');

        //## Questions
        Route::get('questions', \Quiz\Api\Api\Http\Controllers\QuestionController::class . '@index');
        Route::post('questions', \Quiz\Api\Api\Http\Controllers\QuestionController::class . '@create');
        Route::get('questions/{question}', \Quiz\Api\Api\Http\Controllers\QuestionController::class . '@show');
        Route::put('questions/{question}', \Quiz\Api\Api\Http\Controllers\QuestionController::class . '@show');
        Route::delete('questions/{question}', \Quiz\Api\Api\Http\Controllers\QuestionController::class . '@destroy');
        Route::put('questions/{question}/restore', \Quiz\Api\Api\Http\Controllers\QuestionController::class . '@restore');

        //## Question Option
        Route::get('questions/{question}/options', \Quiz\Api\Api\Http\Controllers\QuestionOptionController::class . '@index');
        Route::post('questions/{question}/options', \Quiz\Api\Api\Http\Controllers\QuestionOptionController::class . '@create');
        Route::get('questions/{question}/options/{questionOption}', \Quiz\Api\Api\Http\Controllers\QuestionOptionController::class . '@show');
        Route::put('questions/{question}/options/{questionOption}', \Quiz\Api\Api\Http\Controllers\QuestionOptionController::class . '@show');
        Route::delete('questions/{question}/options/{questionOption}', \Quiz\Api\Api\Http\Controllers\QuestionOptionController::class . '@destroy');
        Route::put('questions/{question}/restore/options/{questionOption}', \Quiz\Api\Api\Http\Controllers\QuestionOptionController::class . '@restore');



    });  // END -- ROUTE GROUP PREFIX FUNC

}); // END -- ROUTE GROUP MIDDLEWARE FUNC