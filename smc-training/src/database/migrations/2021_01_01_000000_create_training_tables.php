<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateTrainingTables extends Migration
{

    public array $tableNames;
    public function __construct()
    {
        $this->tableNames = config('smc-training.table_names');
    }

    private function _setup()
    {

        //## Courses

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

        Schema::create('courses', function (Blueprint $table) {
            $table->id('id');

            $table->foreignId('course_type_id')->nullable()->constrained($this->tableNames['course_types'])->cascadeOnDelete();

            //Organization/Account/Company Name
            $table->string('name')->nullable();

            /* long description of pricing object */
            $table->text('description')->nullable();

            //Is account enabled
            $table->boolean('is_enabled')->default(false);

            /*Timestamps/Datetime*/
            $table->softDeletes();
            $table->timestamps();
        });

        // Quiz, Questions and Topics Relations Table
        Schema::create($this->tableNames['courseables'], function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->nullable()->constrained($this->tableNames['courses'])->cascadeOnDelete();
            $table->unsignedInteger('courseable_id');
            $table->string('courseable_type');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('course_media_items', function (Blueprint $table) {
            $table->id();
            $table->string('version_slug');
            $table->string('name');
            /* long description of object */
            $table->text('description')->nullable();

            //$table->string('media_name')->nullable();
            //$table->string('media_type')->nullable();
            //$table->string('media_location')->nullable();

            $table->foreignId('parent_id')->nullable()->constrained('course_media_items')->nullOnDelete();

            /*Timestamps/Datetime*/
            $table->softDeletes();
            $table->timestamps();
        });

        /**
         * Attachments
         */
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();

            //attachable
            $table->string('attachable_type')->nullable();
            $table->integer('attachable_id')->unsigned()->nullable();

            // Attachment
            $table->integer('attachment_file_size')->unsigned()->nullable();
            //Original File Name
            $table->string('attachment_file_name')->nullable();
            $table->string('attachment_location')->nullable();
            $table->string('attachment_content_type')->nullable();

            /*Timestamps*/
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

            $table->unsignedInteger('assigned_by_id')->nullable();
            $table->string('assigned_by_type')->nullable();

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