<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBugHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("bug_history", function(Blueprint $table)
        {
            $table->increments('id');
            $table->bigInteger("bug_id");
            $table->string("operation");
            $table->string("comment")->default('');
            $table->bigInteger("created_by");
            $table->bigInteger("updated_by");
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
