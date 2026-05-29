<?php

namespace Training\Api\Database\Seeders;

use Illuminate\Database\Seeder;
use Training\Api\Models\CourseType;

class CourseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'name' => 'pdf_document',
            ],
            [
                'name' => 'video',
            ],
            [
                'name' => 'quiz',
            ]
        ];
        foreach ($types as $itemType) {
            CourseType::create($itemType);
        }
    }
}