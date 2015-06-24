<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BaseProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create("project", function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->timestamp('deleted_at')->nullable();
            $table->nullabletimestamps();
        }); 

        Schema::create("version", function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->bigInteger('product_id');
            $table->timestamp('deleted_at')->nullable();
            $table->nullabletimestamps();
        }); 

        Schema::create("module", function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->bigInteger('project_id');
            $table->timestamp('deleted_at')->nullable();
            $table->nullabletimestamps();
        }); 

        Schema::create("team", function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->bigInteger('project_id');
            $table->timestamp('deleted_at')->nullable();
            $table->nullabletimestamps();
        }); 

        Schema::create("team_member", function(Blueprint $table){
            $table->increments('id');
            $table->bigInteger('team_id');
            $table->bigInteger('user_id');
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
        Schema::drop("project");
        Schema::drop("version");
        Schema::drop("module");
        Schema::drop("team");
        Schema::drop("team_member");
    }
}
