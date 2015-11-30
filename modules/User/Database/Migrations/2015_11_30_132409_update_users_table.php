<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{

    public function up()
    {
        # Если таблица в БД существует
        if (Schema::hasTable('users')) {

            # Новые поля
            Schema::table('users', function (Blueprint $table) {

                $table->string('status')->after('surname')->nullable(); # Статус
                $table->string('hobby')->after('surname')->nullable(); # Увлечения / Интересы
                $table->string('activity')->after('surname')->nullable(); # Деятельность / чем занимается

                $table->string('social_network_vk')->after('surname')->nullable();
                $table->string('social_network_fb')->after('surname')->nullable();
                $table->string('social_network_tw')->after('surname')->nullable(); # Twitter
                $table->string('social_network_in')->after('surname')->nullable(); # Instagram
                $table->string('social_network_skype')->after('surname')->nullable(); # Skype
                $table->string('social_homepage')->after('surname')->nullable(); # Personal homepage (site)

                # Семейное положение. 0 - не установлено.
                $table->smallInteger('relationship', false, true)->after('surname');
                $table->string('location')->after('surname')->nullable(); # Место проживания
                $table->string('city')->after('surname')->nullable(); # Город
                $table->string('country')->after('surname')->nullable(); # Страна
                # Тип отображения даты - 0 отображать полностью, 1 - только месяц и год 2 - только месяц и число 3 - только год и т.п
                $table->smallInteger('date_of_birth_view_type', false, true)->after('surname');
                $table->string('date_of_birth', strlen('dd.mm.yyyy'))->after('surname')->nullable(); # дата рождения
                $table->string('anonymous_nick')->after('surname')->nullable(); #Псевдоним


            });

        }
    }

    public function down()
    {
        Schema::table('users', function ($table) {
            $table->dropColumn([
                'hobby',
                'activity',
                'social_network_vk',
                'social_network_fb',
                'social_network_tw',
                'social_network_in',
                'social_network_skype',
                'social_homepage',
                'relationship',
                'location',
                'city',
                'country',
                'date_of_birth_view_type',
                'date_of_birth',
                'anonymous_nick',
            ]);
        });
    }

}
