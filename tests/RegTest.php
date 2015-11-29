<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegTest extends TestCase
{
    /**
     * Обычная регистрация
     */
    public function testRegistration()
    {
        $email = str_random(6).'@test.ru';

        $this->visit('/')
            ->type($email, 'email')
            ->press('Регистрация')
            ->see('Вы успешно зарегистрировались!');

        $this->seeInDatabase('users_activation', [
            'email' => $email
        ]);

    }

    /**
     * Регистрация с невалидным емеилом
     */
    public function testFailedRegistration()
    {
        $email = '\',//.,qrqqw@test.ru';

        $this->visit('/')
            ->type($email, 'email')
            ->press('Регистрация')
            ->see('Упс. Похоже не удалось вас зарегистрировать:');

        $this->dontSeeInDatabase('users_activation', [
            'email' => $email
        ]);

    }

    /**
     * Регистрация с существующим емеилом в БД
     */
    public function testSecondReg()
    {
        $email = str_random(6).'@test.ru';

        $this->visit('/')
            ->type($email, 'email')
            ->press('Регистрация')
            ->see('Вы успешно зарегистрировались!');

        $this->visit('/')
            ->type($email, 'email')
            ->press('Регистрация')
            ->see('Упс. Похоже не удалось вас зарегистрировать:');

    }


        /*


        factory(Modules\User\Entities\User::class, 3)->create(
            function (Faker\Generator $faker) {
                return [
                    'name' => $faker->name,
                    'email' => $faker->email,
                    'password' => bcrypt(str_random(10)),
                    'remember_token' => str_random(10),
                ];
            }
        );
        */

/*
    public function testActivation()
    {
        $this->visit('/user/activation')
            ->type('mail@test.ru', 'email')
            #->check('terms')
            ->press('Регистрация')
            ->see('Вы успешно зарегистрировались!');
    }
*/
}
