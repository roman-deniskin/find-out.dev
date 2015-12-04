@extends('layouts.master')

@section('head')
<link href="{{ asset("css/register.css") }}" rel="stylesheet">
@endsection

@section('content')

    <div class="container registerForm col-md-12">

        @if ($errors->has())
            <div class="card-panel teal">
                <span class="white-text">
                {{ trans('user::messages.ERROR_IN_REG2') }}

                    @foreach($errors->get('email') as $arr)
                        <li>{{ trans('user::messages.'.$arr, [
                'att' => trans('user::names.email'),
                ]) }}</li>
                    @endforeach

                    @foreach($errors->get('login') as $arr)
                        <li>{{ trans('user::messages.'.$arr, [
                'att' => trans('user::names.login'),
                ]) }}</li>
                    @endforeach

                    @foreach($errors->get('password') as $arr)
                        <li>{{ trans('user::messages.'.$arr, [
                'att' => trans('user::names.password'),
                ]) }}</li>
                    @endforeach
                </span>
            </div>
        @endif

        <h1 class="H1Text greetingText">
            {{ trans('user::messages.PLZ_FILL_ALL_FIELDS') }}
        </h1>

        <form class="form-horizontal" role="form" method="post" action="{{ url('user/save') }}">
            {!! csrf_field() !!}
            <input type="hidden" value="{{ $email }}" name="email" />
            <div class="form-group settingsBlock col-md-12">
              <label class="col-md-2 col-md-offset-3 control-label">{{ trans('user::names.login') }}:</label>
              <div class="col-md-3 inputWraper">
                <input type="text" autocomplete="off" placeholder="{{ trans('user::names.login') }}" class="inputRegisterField" value="" name="login" required="true">
              </div>
              <div class="col-md-3 hintWarper">
                <div class="col-md-3 hint" id="">
                  <p>С помощью логина и пароля вы будите заходить на сайт.</p>
                </div>
              </div>
            </div>
            <div class="form-group settingsBlock col-md-12">
              <label class="col-md-2 col-md-offset-3 control-label">{{ trans('user::names.password') }}:</label>
              <div class="col-md-3 inputWraper">
                <input type="password" autocomplete="off" placeholder="{{ trans('user::names.password') }}" class="inputRegisterField" value="" name="password" required="true">
              </div>
              <div class="col-md-3 hintWarper">
                <div class="col-md-3 hint">
                  <p>С помощью логина и пароля вы будите заходить на сайт.</p>
                </div>
              </div>
            </div>
            <div class="form-group settingsBlock col-md-12">
              <label class="col-md-2 col-md-offset-3 control-label">{{ trans('user::names.name') }}:</label>
              <div class="col-md-3 inputWraper">
                <input type="text" autocomplete="off" placeholder="{{ trans('user::names.name') }}" class="inputRegisterField" value="" name="name" required="true">
              </div>
              <div class="col-md-3 hintWarper">
                <div class="col-md-3 hint">
                  <p>Указывайте только ваше настоящее имя. Это нужно для того, чтобы вас могли находить ваши друзья в поиске.</p>
                </div>
              </div>
            </div>
            <div class="form-group settingsBlock col-md-12">
              <label class="col-md-2 col-md-offset-3 control-label">{{ trans('user::names.surname') }}:</label>
              <div class="col-md-3 inputWraper">
                <input type="text" autocomplete="off" placeholder="{{ trans('user::names.surname') }}" class="inputRegisterField" value="" name="surname" required="true">
              </div>
              <div class="col-md-3 hintWarper">
                <div class="col-md-3 hint">
                  <p>В этом поле введите свою настоящую фамилию. Не следует указывать вымешленную фамилию иначе вас не найдут друзья. Фамилия и имя показывается на странице вашего профиля и не будет видна при отправке анонимных сообщений.</p>
                </div>
              </div>
            </div>
            <div class="form-group settingsBlock col-md-12">
              <label class="col-md-2 col-md-offset-3 control-label">Псевдоним:</label>
              <div class="col-md-3 inputWraper">
                <input type="text" autocomplete="off" placeholder="Псевдоним" class="inputRegisterField" value="" name="anonymous_nick" required="true">
              </div>
              <div class="col-md-3 hintWarper">
                <div class="col-md-4 hint">
                  <p>Это ваш псевдоним (вымышленное имя). Если вы отправите кому то анонимное сообщение или анонимный комментирий, то будет виден только ваш псевдоним. Не в коем случае не указывайте в качестве псевдонима никаких данных по которым можно будет догадаться о том, кто вы в т.ч. реальные имя и фамилию.</p>
                </div>
              </div>
            </div>
            <div class="input-field col s12">
                <select id="gender" name="gender">
                    <option value="1">{{ trans('user::names.gender.men') }}</option>
                    <option value="0">{{ trans('user::names.gender.women') }}</option>
                </select>
                <label for="gender">{{ trans('user::names.gender') }}</label>
            </div>
            <div class="col-md-12 registerButtonWarper">
                <button type="submit" class="button">{{ trans('user::names.registration') }}</button>
            </div>
        </form>
    </div>
@stop