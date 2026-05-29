<?php

namespace Training\Api\Database\Seeders;

use Illuminate\Database\Seeder;
use Quiz\Api\Models\Question;
use Quiz\Api\Models\QuestionOption;
use Quiz\Api\Models\QuestionType;
use Quiz\Api\Models\Quiz;
use Quiz\Api\Models\QuizQuestion;
use Training\Api\Models\Attachment;
use Training\Api\Models\Course;
use Training\Api\Models\Courseable;
use Training\Api\Models\CourseMediaItem;
use Training\Api\Models\CourseQuiz;

class CourseMediaItemCsvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        echo PHP_EOL . 'Running CourseMediaItemCsvSeeder...' . PHP_EOL;

        //..
        $file = fopen(__DIR__."/./data/course_media_items.csv","r");
        $items_data = [];
        $row = 0;
        /**
         * 0.id
         * 1.name
         * 2.description
         * id,
         * name,
         * description,
         * version_slug,
         * attachment_file_size,
         * attachment_file_name,
         * attachment_location,
         * attachment_content_type,
         * parent_id

         */
        if (($handle = $file) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $row++;
                //skip first
                if($row === 1){
                    //return;
                    //return;
                } else {


                    $course = Course::create([
                        'name' => $data[1],
                        'description' => $data[0] . '|' .$data[2]
                    ]);

                    $model = CourseMediaItem::create([
                        'name' => $data[1],
                        'description' => $data[0] . '|' .$data[2],
                        'version_slug' => $data[3],
                        'parent_id' =>  (!empty($data[8]) ? $data[8] : null)
                    ]);

                    $courseable = Courseable::create([
                        'course_id' => $course->id,
                        'courseable_id' => $model->id,
                        'courseable_type' => get_class($model),
                    ]);

                    $attachment = Attachment::create([
                        'attachable_id' => $model->id,
                        'attachable_type' => get_class($model),
                        'attachment_file_size' => $data[4],
                        'attachment_file_name' => $data[5],
                        'attachment_location' => $data[6],
                        'attachment_content_type' => $data[7],
                    ]);

                    //

                    //Add to array
                    $items_data[$data[0]] = $model;
                }


            }
            fclose($handle);
        }

        echo PHP_EOL . 'SEEDED CourseMediaItems:'. count($items_data) . PHP_EOL;



    }
}