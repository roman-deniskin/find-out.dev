<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersDataTable extends Migration
{

    public function up()
    {

        Schema::create('users_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');

            $table->string('first_name')->nullable(); # Имя
            $table->string('last_name')->nullable(); # Фамилия
            $table->enum('gender', [0,1])->default(1); // 0 women / 1 men

            $table->string('status')->nullable(); # Статус
            $table->string('hobby')->nullable(); # Увлечения / Интересы
            $table->string('activity')->nullable(); # Деятельность / чем занимается

            $table->string('social_network_vk')->nullable();
            $table->string('social_network_fb')->nullable();
            $table->string('social_network_tw')->nullable(); # Twitter
            $table->string('social_network_in')->nullable(); # Instagram
            $table->string('social_network_skype')->nullable(); # Skype
            $table->string('social_homepage')->nullable(); # Personal homepage (site)

            # Семейное положение. 0 - не установлено.
            $table->smallInteger('relationship', false, true);
            $table->string('location')->nullable(); # Место проживания
            $table->string('city')->nullable(); # Город
            $table->string('country')->nullable(); # Страна

            $table->string('date_of_birth', strlen('dd.mm.yyyy'))->nullable(); # дата рождения
            $table->string('anonymous_nick')->nullable(); #Псевдоним

            $table->integer('updated_at');
            $table->integer('created_at');
        });

    }

    public function down()
    {
        Schema::drop('users_data');
    }

}
