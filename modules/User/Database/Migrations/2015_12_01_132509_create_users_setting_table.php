<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersSettingTable extends Migration
{

    public function up()
    {

        Schema::create('users_setting', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');

            # Тип отображения даты - 0 отображать полностью, 1 - только месяц и год 2 - только месяц и число 3 - только год и т.п
            $table->enum('date_of_birth_view_type', [0,1,2,3,4,5,6]);
            //language = ru / en / uk / pl etc..
            $table->string('lang', 2);

            $table->integer('updated_at');
            $table->integer('created_at');
        });

    }

    public function down()
    {
        Schema::drop('users_setting');
    }

}
