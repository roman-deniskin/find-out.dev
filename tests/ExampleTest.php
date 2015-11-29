<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    /**
     * Обычная регистрация
     */
    /*public function testRegistration()
    {
        $email = str_random(6).'@test.ru';
        $this->visit('/')
            ->type($email, 'email')
            ->press('Регистрация')
            ->see('Вы успешно зарегистрировались!');
        $this->seeInDatabase('users_activation', [
            'email' => $email
        ]);
    }*/
    public function testRegistrationLogin()
    {
        $response = $this->call('GET', 'user/profile');
        $login = str_random(8).'';
        $this->visit('/')
            ->type($login, 'text')
            ->press('Регистрация')
            ->see('Вы успешно зарегистрировались!');
        $this->seeInDatabase('users', [
            'login' => $login
        ]);
    }
}