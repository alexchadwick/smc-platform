<?php

return [

    /*
    |--------------------------------------------------------------------------
    | API
    |--------------------------------------------------------------------------
    |
    | API Settings
    |
    */
    'api_prefix' => 'api/v1',


    /*
    |--------------------------------------------------------------------------
    | Table Names on Database
    |--------------------------------------------------------------------------
    |
    | Enter the names of the tables.
    |
    */

    'table_names' => [
        'topics'               => 'topics',
        'question_types'       => 'question_types',
        'questions'            => 'questions',
        'topicables'           => 'topicables',
        'question_options'     => 'question_options',
        'quizzes'              => 'quizzes',
        'quiz_questions'       => 'quiz_questions',
        'quiz_attempts'        => 'quiz_attempts',
        'quiz_attempt_answers' => 'quiz_attempt_answers',
        'quiz_authors'         => 'quiz_authors'
    ],

    /*
    |--------------------------------------------------------------------------
    | Models Name
    |--------------------------------------------------------------------------
    |
    | Allow to override Quiz table to extend code
    |
    */

    'models' => [

        /*
         * Default Quiz\Api\Models\Question::class
         */

        'question' => Quiz\Api\Models\Question::class,

        /*
         * Default Quiz\Api\Models\Question::class
         */

        'question_option' => Quiz\Api\Models\QuestionOption::class,

        /*
         * Default Quiz\Api\Models\Question::class
         */

        'question_type' => Quiz\Api\Models\QuestionType::class,

        /*
         * Default Quiz\Api\Models\Quiz::class
         */

        'quiz' => Quiz\Api\Models\Quiz::class,

        /*
         * Default Quiz\Api\Models\QuizAttempt::class
         */

        'quiz_attempt' => Quiz\Api\Models\QuizAttempt::class,

        /*
         * Default Quiz\Api\Models\QuizAttempt::class
         */

        'quiz_attempt_answer' => Quiz\Api\Models\QuizAttemptAnswer::class,

        /*
         * Default Quiz\Api\Models\QuizAttempt::class
         */

        'quiz_author' => Quiz\Api\Models\QuizAuthor::class,

        /*
         * Default Quiz\Api\Models\QuizAttempt::class
         */

        'quiz_question' => Quiz\Api\Models\QuizQuestion::class,

        /*
         * Default Quiz\Api\Models\QuizAttempt::class
         */

        'topic' => Quiz\Api\Models\Topic::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Question type mapping
    |--------------------------------------------------------------------------
    |
    | You can choose which method to use for scoring.
    |
    */

    'get_score_for_question_type' => [
        1 => '\Quiz\Api\Models\QuizAttempt::get_score_for_type_1_question',
        2 => '\Quiz\Api\Models\QuizAttempt::get_score_for_type_2_question',
        3 => '\Quiz\Api\Models\QuizAttempt::get_score_for_type_3_question',
    ],

    /*
    |--------------------------------------------------------------------------
    | Question type answer/solution render
    |--------------------------------------------------------------------------
    |
    | Render correct answer and given response for different question types
    |
    */
    'render_answers_responses'    => [
        1  => '\Quiz\Api\Models\QuizAttempt::renderQuestionType1Answers',
        2  => '\Quiz\Api\Models\QuizAttempt::renderQuestionType2Answers',
        3  => '\Quiz\Api\Models\QuizAttempt::renderQuestionType3Answers',
    ]

];
