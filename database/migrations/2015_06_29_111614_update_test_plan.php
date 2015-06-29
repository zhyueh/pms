<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTestPlan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop("text_plan_name");

        //
        Schema::create("test_plan", function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('test_plan_name');
            $table->bigInteger('version_id');

            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
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
