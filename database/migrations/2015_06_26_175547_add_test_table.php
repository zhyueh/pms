<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create("test_case", function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('test_case_name');
            $table->integer('test_case_type');
            $table->bigInteger('story_id');
            $table->text('precondition');
            $table->text('test_step');
            $table->integer('test_sequence');
            $table->text('remark');
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->timestamp('deleted_at')->nullable();
            $table->nullabletimestamps();
        });

        Schema::create("test_plan", function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('text_plan_name');
            $table->bigInteger('version_id');

            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->timestamp('deleted_at')->nullable();
            $table->nullabletimestamps();
        });

        Schema::create("test_result", function (Blueprint $table)
        {
            $table->increments('id');
            $table->bigInteger('test_plan_id');
            $table->bigInteger('test_case_id');
            $table->integer('success');
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->timestamp('deleted_at')->nullable();
            $table->nullabletimestamps();
        });

        Schema::create("bug", function(Blueprint $table)
        {
            $table->increments('id');
            $table->bigInteger('test_case_id')->default(0);
            $table->bigInteger('deployment_id')->default(0);
            $table->string('bug_name');
            $table->bigInteger('team_id');
            $table->bigInteger('owner_id');

            $table->text('description');
            $table->text('requirement');
            $table->integer('active_times')->default(0);

            $table->integer('status');
            $table->integer('serverity');
            $table->integer('priority');

            $table->timestamp('confirm_time')->nullable();
            $table->timestamp('fix_time')->nullable();
            $table->timestamp('close_time')->nullable();

            $table->bigInteger('created_by');
            $table->bigInteger('closed_by');
            $table->bigInteger('updated_by');
            $table->timestamp('deleted_at')->nullable();
            $table->nullabletimestamps();
        });

        Schema::create("comment", function (Blueprint $table)
        {
            $table->increments('id');
            $table->text("content");

            $table->bigInteger("imageable_id");
            $table->string("imageable_type");

            $table->bigInteger("created_by");
            $table->bigInteger("updated_by");
            $table->timestamp("deleted_at")->nullable();
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
