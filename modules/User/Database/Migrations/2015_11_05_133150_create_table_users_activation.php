<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsersActivation extends Migration {

    public function up()
    {
        Schema::create('users_activation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique()->index();
            $table->string('token')->unique()->index();
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
        Schema::drop('users_activation');
    }
}
