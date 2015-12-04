@extends('layouts.master')

@section('title', 'Профиль '.$account->data->first_name)

@section('description', 'Find-Out meta-description')
@section('keywords', 'Find-Out meta-keywords')

@section('head')
    <link href="{{ asset("css/profile.css") }}" rel="stylesheet">
    <link href="{{ asset("css/font-awesome.min.css") }}" rel="stylesheet">
@endsection

@section('background')
    style="background: #ececec;"
@endsection

<?php
/* Список полей:
    'login' => 'Логин',
    'password' => 'Пароль',
    'email' => 'E-Mail',

    'name' => 'Имя',
    'surname' => 'Фамилия',

    Получить "Имя Фамилия", всмысле через пробел, можно методом:
    $account->getFullName()
    где $account объект класа User (тут и в следующих заметках)

    'gender' => 'Пол',
    $account->getGender() - Мужчина / Женщина, в зависимости от пола юзера

    'date_of_birth' => 'Дата рождения',
    Получить дату рождения с учётом настроек пользователя (что отображать, а что нет)
    можно методом:
    $account->getBirthDate()


    'country' => 'Страна',
    'city' => 'Город',
    'hobby' => 'Увлечения',
    'activity' => 'Деятельность',
    'social_network_vk' => 'Профиль ВКонтакте',
    'social_network_fb' => 'Профиль Facebook',
    'social_network_tw' => 'Страница в Twitter',
    'social_network_in' => 'Страница в Instagram',
    'social_network_skype' => 'Skype',
    'social_homepage' => 'Сайт',
    'relationship' => 'Семейное положение',
    Получить перевод семейного положения с учётом пола юзера можно методом:
    $account->getUserRelationship()

    'location' => 'Место жительства',
    'anonymous_nick' => 'Анонимный псевдоним',
    'status' => 'Статус',
 */
?>

@section('content')

    <div class="container contentContainer">
        <div class="content col-xs-12">
            <div class="leftCol col-xs-2">
                <div class="innerWrapperLeftMenu">
                    <div class="leftAvatar">
                        <img class="leftAvatarImg img-circle" src="/img/user/squareAvatar.jpg">
                    </div>
                    <div class="profileSwitch">
                        <div class="switch">
                            <div class="switcher"></div>
                        </div>
                        <div class="profileSwitchTextWarper">
                            <a class="profileSwitchText">Публичная страница</a>
                            <a class="profileSwitchText">Анонимная страница</a>
                        </div>
                    </div>
                    <div class="leftMenu">
                        <ul id="nav1">
                            <a class="leftMenuLink" href="#1">
                                <li class="leftMenuLi active">
                                    <div class="iconWraper"><i class="fa fa-user"></i></div>
                                    Профиль
                                </li>
                            </a>
                            <a class="leftMenuLink" href="#2">
                                <li class="leftMenuLi">
                                    <div class="iconWraper"><i class="fa fa-users"></i></div>
                                    Друзья
                                </li>
                            </a>
                            <a class="leftMenuLink" href="#3">
                                <li class="leftMenuLi">
                                    <div class="iconWraper"><i class="fa fa-camera-retro"></i></div>
                                    Фотографии
                                </li>
                            </a>
                            <a class="leftMenuLink" href="#4">
                                <li class="leftMenuLi">
                                    <div class="iconWraper"><i class="fa fa-envelope"></i>
                                    </div>
                                    Сообщения
                                    <div class="leftMenuCounter">9+</div>
                                </li>
                            </a>
                            <a class="leftMenuLink" href="#5">
                                <li class="leftMenuLi">
                                    <div class="iconWraper"><i class="fa fa-commenting-o"></i>
                                    </div>
                                    Вопросы
                                    <div class="leftMenuCounter">5</div>
                                </li>
                            </a>
                            <a class="leftMenuLink" href="#6">
                                <li class="leftMenuLi">
                                    <div class="iconWraper"><i class="fa fa-star"></i></div>
                                    Закладки
                                </li>
                            </a>
                            <a class="leftMenuLink" href="#7">
                                <li class="leftMenuLi">
                                    <div class="iconWraper"><i class="fa fa-cog"></i></div>
                                    Настройки
                                </li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="userPage col-xs-10 col-xs-offset-2">
                <div class="userTopInfoWraper">
                    <div class="avatarWarper">
                        <img class="avatarImg" src="/img/user/squareAvatar.jpg">

                        <div class="subAvatarMenuWraper">
                            <ul id="">
                                <a class="subAvatarMenuLink" href="/settings/data">
                                    <li class="subAvatarMenuLi">
                                        <div class="iconWraper"><i class="fa fa-pencil-square-o subAvatarIcon"></i>
                                        </div>
                                        Редактировать страницу
                                    </li>
                                </a>
                                <a class="subAvatarMenuLink" href="#2">
                                    <li class="subAvatarMenuLi">
                                        <div class="iconWraper"><i class="fa fa-gift subAvatarIcon"></i></div>
                                        Мои подарки
                                    </li>
                                </a>
                            </ul>
                        </div>
                    </div>
                    <div class="userPageRightInfCol">
                        <div class="nameWraper"><h1 class="userNameText">{{ $account->getFullName() }}</h1></div>
                        <div class="userStatusWraper">
                            <div class="userPageRightInfColStatusTill"></div>
                            <a class="userStatusText" href="#">{{ $data->status }}</a>
                        </div>
                        <div class="submitPostWrapper">
                            <p class="submitPostText">Добавить запись на стену</p>
                            <textarea class="submitPostTextarea"></textarea>
                            <button class="submitPostButton">Отправить</button>
                            <div class="iconesWrapper">
                                <a href="#"><i class="fa fa-smile-o wallIcones"></i></a>
                                <a href="#"><i class="fa fa-camera-retro wallIcones"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="wall">
                    <div class="wallPost">
                        <div class="leftColImgWrapper">
                            <img class="wallPostAvatarImage" src="/img/user/squareAvatar.jpg"/>
                        </div>
                        <div class="rightColPostContentWrapper">
                            <div class="autor"><a class="autorLink" href="#">Роман Денискин</a></div>
                            <div class="datatime">12 ноября 2015 15:06</div>
                            <div class="wallPostContent">
                                <div class="userPageRightInfColWallPostTill"></div>
                                <p class="wallPostText">Предлагаю запретить слова. Есть информация, что с помощью них общаются террористы. (C) Дуров П.</p>
                            </div>
                        </div>
                    </div>
                    <div class="wallPost">
                        <div class="leftColImgWrapper">
                            <img class="wallPostAvatarImage" src="/img/user/squareAvatar.jpg"/>
                        </div>
                        <div class="rightColPostContentWrapper">
                            <div class="autor"><a class="autorLink" href="#">Роман Денискин</a></div>
                            <div class="datatime">12 ноября 2015 15:06</div>
                            <div class="wallPostContent">
                                <div class="userPageRightInfColWallPostTill"></div>
                                <p class="wallPostText">"Страх превращает свободных людей в слипшуюся массу разрозненных
                                    тел" – художник Петр Павленский, поджегший вчера здание ФСБ. (C) Дуров П.</p>

                                <div class="wallPostImagesWrapper">
                                    <img class="wallPostImage" src="/img/userImages/1.jpg"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- $account->login --}}
                {{-- $account->email --}}
                {{-- trans('user::names.gender') --}}
                {{-- $account->gender ? trans('user::names.gender.men') : trans('user::names.gender.women') --}}
            </div>
        </div>
    </div>
@stop