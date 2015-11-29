@extends('layouts.master')

@section('title') {{ trans('user::settings.settings') }} @endsection

@section('content')

    <div class="container">

        <h1>{{ trans('user::names.profile.edit') }}</h1>

        @if ($errors->has())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @include('user::settings.tabs', ['active' => 'data'])

        <form role="form" method="post" action="{{ url('user/profile/update') }}">
            {!! csrf_field() !!}

            <label for="login">{{ trans('user::names.login') }}</label>
            <input type="text" class="form-control" id="name" placeholder="{{ trans('user::names.login') }}" name="login" value="{{ $user->login }}">
            <br>

            <label for="old_password">{{ trans('user::names.old_password') }}</label>
            <input type="password" class="form-control" id="old_password" placeholder="{{ trans('user::names.old_password') }}" name="old_password">
            <br>

            <label for="new_password">{{ trans('user::names.new_password') }}</label>
            <input type="password" class="form-control" id="new_password" placeholder="{{ trans('user::names.new_password') }}" name="new_password">
            <br>

            <label for="new_password_2">{{ trans('user::names.new_password_2') }}</label>
            <input type="password" class="form-control" id="new_password_2" placeholder="{{ trans('user::names.new_password_2') }}" name="new_password_2">
            <br>

            <br>

            <button type="submit" class="btn btn-default">{{ trans('user::names.profile.save') }}</button>
        </form>

    </div>

@stop