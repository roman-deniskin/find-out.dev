@extends('layouts.master')

@section('title', trans('user::settings.settings'))

@section('content')

    <div class="container">

        <h1>{{ trans('user::names.profile.edit') }}</h1>

        @if ($errors->has())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->get('email') as $error)
                        <li>{{ trans('user::settings.valid.email.'.$error) }}</li>
                    @endforeach

                    @foreach ($errors->get('login') as $error)
                        <li>{{ trans('user::settings.valid.login.'.$error) }}</li>
                    @endforeach

                    @foreach ($errors->get('old_password') as $error)
                        <li>{{ trans('user::settings.valid.old_password.'.$error) }}</li>
                    @endforeach

                    @foreach ($errors->get('new_password') as $error)
                        <li>{{ trans('user::settings.valid.new_password.'.$error) }}</li>
                    @endforeach

                    @foreach ($errors->get('new_password2') as $error)
                        <li>{{ trans('user::settings.valid.new_password2.'.$error) }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @include('user::settings.tabs', ['active' => 'index'])

        <form role="form" method="post" action="{{ url('/settings') }}">
            {!! csrf_field() !!}

            <label for="login">{{ trans('user::names.login') }}</label>
            <input type="text" class="form-control" id="login" placeholder="{{ trans('user::names.login') }}"
                   name="login"
                   value="{{ !empty(old($user->login)) ? old($user->login) : $user->login }}">
            <br>

            <label for="anonymous_nick">{{ trans('user::names.anonymous_nick') }}</label>
            <input type="text" class="form-control" id="anonymous_nick" placeholder="{{ trans('user::names.anonymous_nick') }}"
                   name="anonymous_nick"
                   value="{{ !empty(old($user->data->anonymous_nick)) ? old($user->data->anonymous_nick) : $user->data->anonymous_nick }}">
            <br>

            <label for="email">{{ trans('user::names.email') }}</label>
            <input type="text" class="form-control" id="email" placeholder="{{ trans('user::names.email') }}"
                   name="email"
                   value="{{ !empty(old($user->email)) ? old($user->email) : $user->email }}">
            <br>

            <label for="old_password">{{ trans('user::names.old_password') }}</label>
            <input type="password" class="form-control" id="old_password"
                   placeholder="{{ trans('user::names.old_password') }}" name="old_password">
            <br>

            <label for="new_password">{{ trans('user::names.new_password') }}</label>
            <input type="password" class="form-control" id="new_password"
                   placeholder="{{ trans('user::names.new_password') }}" name="new_password">
            <br>

            <label for="new_password_2">{{ trans('user::names.new_password_2') }}</label>
            <input type="password" class="form-control" id="new_password_2"
                   placeholder="{{ trans('user::names.new_password_2') }}" name="new_password_2">
            <br>

            <br>

            <button type="submit" class="btn btn-default">{{ trans('user::names.profile.save') }}</button>
        </form>

    </div>

@stop