<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevPlan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("dev_plan", function(Blueprint $table){
            $table->increments('id');
            $table->bigInteger('story_id');
            $table->bigInteger('team_id');
            $table->timestamp('plan_start_at')->nullable();
            $table->timestamp('plan_complete_at')->nullable();
            $table->timestamp('start_at')->nullable();
            $table->timestamp('complete_at')->nullable();
            $table->integer('status')->default(0);
            $table->text('remark')->nullable();
            $table->integer('priority');
            $table->integer('score')->nullable();
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->timestamp('deleted_at')->nullable();
            $table->nullabletimestamps();
        });
        //
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
