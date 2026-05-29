<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateErpTables extends Migration
{
    public array $tableNames;
    public function __construct()
    {
        $this->tableNames = config('smc-erp.table_names');
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // OrganizationType Table
        Schema::create($this->tableNames['organization_types'], function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->timestamps();
            //$table->softDeletes();
        });

        // Organization Table
        Schema::create($this->tableNames['organizations'], function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->foreignId('organization_type_id')->constrained();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });


        // OrganizationDivision Table
        Schema::create($this->tableNames['organization_divisions'], function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('external_ref')->nullable();
            $table->foreignId('organization_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });

        // Locations Table
        Schema::create($this->tableNames['locations'], function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('external_ref');
            $table->json('map_marker_config');
            $table->unsignedInteger('locationable_id');
            $table->string('locationable_type');
            $table->timestamps();
            $table->softDeletes();
        });

        // Address Table
        Schema::create($this->tableNames['addresses'], function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('external_ref');
            $table->json('map_marker_config');
            $table->unsignedInteger('locationable_id');
            $table->string('locationable_type');
            $table->timestamps();
            $table->softDeletes();
        });

        // Tags Table
        Schema::create($this->tableNames['tags'], function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();
        });

        // Taggable Table
        Schema::create($this->tableNames['taggable'], function (Blueprint $table) {
            $table->id();
            $table->foreignId('tag_id')->constrained();
            $table->unsignedInteger('taggable_id');
            $table->string('taggabletype');
            $table->timestamps();
            $table->softDeletes();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {


        Schema::drop($this->tableNames['organizations']);
        Schema::drop($this->tableNames['organization_types']);
    }
}
