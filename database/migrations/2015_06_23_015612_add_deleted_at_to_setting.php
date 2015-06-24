<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeletedAtToSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table("users", function ($table){
            $table->timestamp('deleted_at')->nullable();
        });
        Schema::table("role", function ($table){
            $table->timestamp('deleted_at')->nullable();
        });
        Schema::table("menu", function ($table){
            $table->timestamp('deleted_at')->nullable();
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
