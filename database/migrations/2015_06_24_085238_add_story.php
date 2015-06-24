<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create("story", function(Blueprint $table){
            $table->increments('id');
            $table->string('story_name');
            $table->bigInteger('module_id');
            $table->bigInteger('version_id');
            $table->text('description');
            $table->text('requirement');
            $table->text('remark');
            $table->integer('priority');
            $table->integer('status');
            $table->bigInteger('created_by');
            $table->timestamp('deleted_at')->nullable();
            $table->nullabletimestamps();
        });

        Schema::create("story_team", function(Blueprint $table){
            $table->increments('id');
            $table->bigInteger('sotry_id');
            $table->bigInteger('team_id');
        });

        Schema::create("story_comment", function(Blueprint $table){
            $table->increments('id');
            $table->bigInteger('story_id');
            $table->bigInteger('team_id');
            $table->text('description');
            $table->integer('difficult');
            $table->integer('work_hour');
            $table->bigInteger('created_by');
            $table->timestamp('deleted_at')->nullable();
            $table->nullabletimestamps();
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
