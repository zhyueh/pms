<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeStatusToEnum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::drop('status');
        Schema::create("enum", function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('type');
            $table->integer('value');
            $table->string('name');
            $table->integer('order');
            $table->bigInteger('created_by');
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
