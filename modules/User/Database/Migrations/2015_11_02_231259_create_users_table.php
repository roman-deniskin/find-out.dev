<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('login')->unique()->index();
            $table->string('email')->unique()->index();
            $table->string('password', 60);

            $table->string('name');
            $table->string('surname');

            $table->boolean('active')->default(0);
            $table->boolean('gender')->default(1); // 1 Men / 0 Women

            $table->rememberToken();
            $table->integer('updated_at');
            $table->integer('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }

}
