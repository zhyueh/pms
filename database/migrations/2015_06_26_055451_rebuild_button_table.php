<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RebuildButtonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::drop("button");

        Schema::create("route", function (Blueprint $table){
            $table->increments('id');
            $table->string('route');
            $table->string('route_name')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->unique('route', 'route');
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
