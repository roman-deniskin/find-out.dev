@extends('layouts.master')

@section('title') Анонимная социальная сеть Find Out @endsection
@section('description') Find-Out meta-description @endsection
@section('keywords') Find-Out meta-keywords @endsection

@section('content')

    <div class="container">

        @if(Auth::check() == false)
            <div class="row">
                <div class="col s12">

                    @if($errors->has())
                        <div class="card-panel teal">
                        <span class="white-text">
                            {{ trans('user::messages.ERROR_IN_REG1') }}<br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ trans('user::messages.email.'.$error) }}</li>
                                @endforeach
                            </ul>
                            </span>
                        </div>
                    @endif


                </div>

                <div class="col s12 m6">
                    <h2>{{ trans('user::names.authorization') }}</h2>

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <label>{{ trans('user::names.login') }}:<br>
                            <input type="text" name="login" value="{{ old('login') }}"/>
                        </label>

                        <br>

                        <label>{{ trans('user::names.password') }}:<br>
                            <input type="text" name="password" value="{{ old('password') }}"/>
                        </label>

                        <button class="btn waves-effect waves-light" type="submit" name="action">
                            {{ trans('user::names.authorization') }}
                            <i class="material-icons right">vpn_key</i>
                        </button>

                    </form>
                </div>

                <div class="col s12 m6">

                    <h2>{{ trans('user::names.registration') }}</h2>

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/registration') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <label>E-mail:<br>
                            <input type="text" name="email" value="{{ old('email') }}"/>
                        </label>

                        <br>

                        <button class="btn waves-effect waves-light" type="submit" name="action">
                            {{ trans('user::names.register') }}
                            <i class="material-icons right">add</i>
                        </button>

                    </form>
                </div>

            </div>

        @else
            <a class="waves-effect waves-light btn"
               href="{{ url('/user/profile/'.Auth::user()->id) }}">{{ trans('user::names.profile.view') }}</a>
            <a class="waves-effect waves-light btn"
               href="{{ url('/user/profile/edit') }}">{{ trans('user::names.profile.edit') }}</a>
            <a class="waves-effect waves-light btn" href="/logout">{{ trans('user::names.logout') }}</a>
        @endif

    </div>

@stop