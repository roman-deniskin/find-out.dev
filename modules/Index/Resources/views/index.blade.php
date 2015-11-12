@extends('index::layouts.master')

@section('content')

    @if(Session::has('message'))
        {{ Session::get('message') }}
    @endif

    @if(Auth::check() == false)
        <h1>{{ trans('user::names.authorization') }}</h1>

        @if($errors->has())
            <div class="alert alert-danger">
                {{ trans('user::messages.ERROR_IN_REG1') }}<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ trans('user::messages.email.'.$error) }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <label>{{ trans('user::names.login') }}:<br>
                <input type="text" name="login" value="{{ old('login') }}"/>
            </label>

            <br>

            <label>{{ trans('user::names.password') }}:<br>
                <input type="text" name="password" value="{{ old('password') }}"/>
            </label>

            <input type="submit" value="{{ trans('user::names.authorization') }}"/>

        </form>

        <hr>

        <h1>{{ trans('user::names.registration') }}</h1>

        <form class="form-horizontal" role="form" method="POST" action="{{ url('/registration') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <label>E-mail:<br>
                <input type="text" name="email" value="{{ old('email') }}"/>
            </label>

            <br>

            <input type="submit" value="{{ trans('user::names.register') }}"/>

        </form>

    @else
        <a href="{{ url('/user/profile/'.Auth::user()->id) }}">{{ trans('user::names.profile.view') }}</a>
        <a href="{{ url('/user/profile/edit') }}">{{ trans('user::names.profile.edit') }}</a>
        <div class="title"><a href="/logout">{{ trans('user::names.logout') }}</a></div>
    @endif

@stop