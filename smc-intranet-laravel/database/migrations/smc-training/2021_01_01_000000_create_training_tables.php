<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateTrainingTables extends Migration
{
    private function _setup()
    {

        //## Courses

        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');

            //Organization/Account/Company Name
            $table->string('name')->nullable();

            /* long description of pricing object */
            $table->text('description')->nullable();

            //Is account enabled
            $table->boolean('is_enabled')->default(false);

            //completion rate
            //


            /*Timestamps/Datetime*/
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('course_types', function (Blueprint $table) {
            $table->id();

            //Organization/Account/Company Name
            $table->string('name')->nullable();

            /* long description of pricing object */
            $table->text('description')->nullable();

            /*Timestamps/Datetime*/
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('course_quizzes', function (Blueprint $table) {
            $table->id();

            /*Timestamps/Datetime*/
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('course_documents', function (Blueprint $table) {
            $table->id();

            /*Timestamps/Datetime*/
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('course_media', function (Blueprint $table) {
            $table->id();

            /*Timestamps/Datetime*/
            $table->softDeletes();
            $table->timestamps();
        });


        //## User Courses
        Schema::create('course_attempts', function (Blueprint $table) {
            $table->id();

            //$table->unsignedInteger('user_id');
            $table->unsignedInteger('participant_id');
            $table->string('participant_type');


            $table->unsignedInteger('course_id');

            //completed_at
            $table->timestamp('completed_at')->default(null)->nullable();
            //started_at
            $table->timestamp('started_at')->default(null)->nullable();
            //last_viewed
            $table->timestamp('last_viewed')->default(null)->nullable();

            //completion rate
            //


            $table->timestamps();
        });

        Schema::create('course_enrollments', function (Blueprint $table) {
            $table->id();

            //$table->unsignedInteger('user_id');
            $table->unsignedInteger('participant_id');
            $table->string('participant_type');

            $table->unsignedInteger('assigned_by_id');
            $table->string('assigned_by_type');

            $table->unsignedInteger('course_id');

            //completed_at
            $table->timestamp('completed_at')->default(null)->nullable();

            $table->softDeletes();
            $table->timestamps();
        });





        //END FUNC ==============================================
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Setup database
         */
        $this->_setup();
        //END =======================================================
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::drop('courses');
        Schema::drop('course_types');
        Schema::drop('user_courses');

    }
}