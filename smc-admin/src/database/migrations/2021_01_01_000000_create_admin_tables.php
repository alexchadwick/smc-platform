<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateAdminTables extends Migration
{

    public array $tableNames;
    public function __construct()
    {
        $this->tableNames = config('smc-admin.table_names');
    }

    private function _setup()
    {

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
        //..
    }
}