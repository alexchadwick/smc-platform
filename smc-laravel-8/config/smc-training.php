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
        'courses'               => 'courses',
        'course_types'               => 'course_types',
        'course_attempts'       => 'course_attempts',
        'course_enrollments'       => 'course_enrollments',

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
         * Default Training\Api\Models\Course::class
         */

        'course' => Training\Api\Models\Course::class,


        /*
         * Default Training\Api\Models\CourseAttempt::class
         */

        'course_attempt' => Training\Api\Models\CourseAttempt::class,


        /*
         * Default Training\Api\Models\CourseEnrollment::class
         */

        'course_enrollment' => Training\Api\Models\CourseEnrollment::class,

        /*
         * Default Training\Api\Models\CourseType::class
         */

        'course_type' => Training\Api\Models\CourseType::class,


    ],

    /*
    |--------------------------------------------------------------------------
    | Course type mapping
    |--------------------------------------------------------------------------
    |
    | You can choose which method to use for scoring.
    |
    */

    'get_view_for_course_type' => [
        1 => '\Training\Api\Models\UserCourse::get_view_for_type_1_course',
        2 => '\Training\Api\Models\UserCourse::get_view_for_type_2_course',
        3 => '\Training\Api\Models\UserCourse::get_view_for_type_3_course',
    ],


];
