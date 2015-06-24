<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('role', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->nullabletimestamps();
        });

        Schema::create('user_role', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id');
            $table->bigInteger('role_id');
            $table->unique('role_id', 'user_id');
            $table->nullabletimestamps();
        });

        Schema::create('menu', function (Blueprint $table) {
            $table->increments('id');
            $table->string('action')->unique();
            $table->string('name');
            $table->nullabletimestamps();
        });

        Schema::create('role_menu', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('role_id');
            $table->bigInteger('menu_id');
            $table->unique('role_id', 'menu_id');
            $table->nullabletimestamps();
        });

        Schema::create('setting', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key')->unique();
            $table->string('value');
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
        Schema::drop("role");
        Schema::drop("user_role");
        Schema::drop("menu");
        Schema::drop("role_menu");
        Schema::drop("setting");
    }
}
