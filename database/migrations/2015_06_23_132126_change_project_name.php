<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeProjectName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table("project", function($table){
            $table->renameColumn('name', 'project_name');
        });

        Schema::table("version", function($table){
            $table->renameColumn('name', 'version_name');
        });

        Schema::table("module", function($table){
            $table->renameColumn('name', 'module_name');
        });

        Schema::table("team", function($table){
            $table->renameColumn('name', 'team_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
