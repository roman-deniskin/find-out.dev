@extends('layouts.master')

@section('title') Профиль {{ $account->login }} @endsection
@section('description') Find-Out meta-description @endsection
@section('keywords') Find-Out meta-keywords @endsection

@section('head')
<link href="{{ asset("css/profile.css") }}" rel="stylesheet">
<link href="{{ asset("css/font-awesome.min.css") }}" rel="stylesheet">
@endsection

@section('content')

    <div class="container">
        <div class="content col-xs-12">
          <div class="leftCol col-xs-2">
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
                      <a class="leftMenuLink" href="#1"><li class="leftMenuLi active"><div class="iconWraper"><i class="fa fa-user"></i></div>Профиль</li></a>
                    <a class="leftMenuLink" href="#2"><li class="leftMenuLi"><div class="iconWraper"><i class="fa fa-users"></i></div>Друзья</li></a>
                    <a class="leftMenuLink" href="#3"><li class="leftMenuLi"><div class="iconWraper"><i class="fa fa-camera-retro"></i></div>Фотографии</li></a>
                    <a class="leftMenuLink" href="#4"><li class="leftMenuLi"><div class="iconWraper"><i class="fa fa-envelope"></i><div class="leftMenuCounter">9+</div></div>Сообщения</li></a>
                    <a class="leftMenuLink" href="#5"><li class="leftMenuLi"><div class="iconWraper"><i class="fa fa-commenting-o"></i><div class="leftMenuCounter">5</div></div>Вопросы</li></a>
                    <a class="leftMenuLink" href="#6"><li class="leftMenuLi"><div class="iconWraper"><i class="fa fa-star"></i></div>Закладки</li></a>
                    <a class="leftMenuLink" href="#7"><li class="leftMenuLi"><div class="iconWraper"><i class="fa fa-cog"></i></div>Настройки</li></a>
                  </ul>
              </div>
          </div>
            <div class="userPage col-xs-10">
                <div class="userTopInfoWraper">
                    <div class="avatarWarper">
                        <img class="avatarImg" src="/img/user/squareAvatar.jpg">
                        <div class="subAvatarMenuWraper">
                            <ul id="">
                              <a class="subAvatarMenuLink" href="#1"><li class="subAvatarMenuLi"><div class="iconWraper"><i class="fa fa-pencil-square-o subAvatarIcon"></i></div>Редактировать страницу</li></a>
                              <a class="subAvatarMenuLink" href="#2"><li class="subAvatarMenuLi"><div class="iconWraper"><i class="fa fa-gift subAvatarIcon"></i></div>Мои подарки</li></a>
                            </ul>
                        </div>
                    </div>
                    <div class="userPageRightInfCol">
                        <div class="nameWraper"><h1 class="userNameText">{{ $account->name.' '.$account->surname }}</h1></div>
                        <div class="userStatusWraper">
                            <div class="userPageRightInfColStatusTill"></div>
                            <a class="userStatusText" href="#">Коммуникация переоценена. Час одиночества продуктивнее недели разговоров.</a>
                        </div>
                        <div class="profileInfo">
                            <div class="profileInfoLeftCol"><p>День рождения:</p></div><div class="profileInfoRightCol"><p>12 августа 1994</p></div>
                            <div class="profileInfoLeftCol"><p>Родной город:</p></div><div class="profileInfoRightCol"><a href="#">Серпухов</a></div>
                            <div class="profileInfoLeftCol"><p>Семейное положение:</p></div><div class="profileInfoRightCol"><a href="#">Свободен</a></div>
                        </div>
                        <div class="showInfo">Показать информацию</div>
                    </div>
                </div>
                <div class="submitPostWrapper">
                    <textarea class="submitPostTextarea"></textarea>
                    <button class="submitPostButton">Отправить</button>
                    <div class="iconesWrapper">
                        <a href="#"><i class="fa fa-smile-o wallIcones"></i></a>
                        <a href="#"><i class="fa fa-camera-retro wallIcones"></i></a>
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
                                <p class="wallPostText">"Страх превращает свободных людей в слипшуюся массу разрозненных тел" – художник Петр Павленский, поджегший вчера здание ФСБ. (C) Дуров П.</p>
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