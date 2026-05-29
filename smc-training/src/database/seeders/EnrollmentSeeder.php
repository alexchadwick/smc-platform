<?php

namespace Training\Api\Database\Seeders;

use Admin\Api\Models\User;
use Illuminate\Database\Seeder;
use Training\Api\Models\Course;
use Training\Api\Models\CourseEnrollment;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        echo PHP_EOL . 'Running EnrollmentSeeder...' . PHP_EOL;


        /*
         * User Import
         */
        foreach (User::all() as $user){
            foreach (Course::all() as $course) {
                $model = CourseEnrollment::create([
                    'participant_id' => $user->id,
                    'participant_type' => config('auth.providers.users.model'),
                    'course_id' => $course->id
                ]);
            }
        }


    }
}