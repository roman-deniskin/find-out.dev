@extends('layouts.master')

@section('title') Анонимная социальная сеть Find Out @endsection
@section('description') Find-Out meta-description @endsection
@section('keywords') Find-Out meta-keywords @endsection

@section('head')
<link href="{{ asset("css/index.css") }}" rel="stylesheet">
@endsection

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

                <div class="formRegister col-md-3">

                    <p class="greetingText">{{ trans('user::names.startUsing') }}</p>

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/registration') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="text" class="registerInput" placeholder="{{ trans('user::names.email') }}" name="email" value="{{ old('email') }}"/>
                        
                        <button class="button" id="registerButton" type="submit" name="action">
                            {{ trans('user::names.registration') }}
                        </button>

                    </form>
                </div>
                <div class="col-md-8 col-md-offset-1 tizerTextClass">
                    <h1 class="tizerText">{{ trans('user::messages.welcome') }}</h1>
                </div>
                <div class="col-md-8 col-md-offset-1">
                    <img class="bannerImage" src="{{ asset("img/banner.png") }}">
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