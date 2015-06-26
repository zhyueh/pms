<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddButtonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create("button", function (Blueprint $table){
            $table->increments('id');
            $table->string('controller');
            $table->string('action');
            $table->string('page_name')->nullable();
            $table->string('button_name')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->unique('controller', 'action');
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
