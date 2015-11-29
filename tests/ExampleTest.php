<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{

    public function testBasicExample(){
        $this->visit('/')
            ->assertResponseOk();
    }

/*
    public function testRegistrationLogin()
    {
        $response = $this->call('GET', 'user/profile');
        $login = str_random(8).'';
        $this->visit('/')
            ->type($login, 'login')
            ->press('Регистрация')
            ->see('Вы успешно зарегистрировались!');
        $this->seeInDatabase('users', [
            'login' => $login
        ]);
    }
*/
}
