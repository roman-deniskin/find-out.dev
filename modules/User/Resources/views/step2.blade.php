@extends('layouts.master')

@section('content')

    <div class="container">

        @if ($errors->has())
            <div class="card-panel teal">
                <span class="white-text">
                {{ trans('user::messages.ERROR_IN_REG2') }}

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

        <p>
            {{ trans('user::messages.PLZ_FILL_ALL_FIELDS') }}
        </p>

        <form role="form" method="post" action="{{ url('user/save') }}">
            {!! csrf_field() !!}


            <label for="email">E-mail</label>
            <input type="hidden" class="form-control" name="email" value="{{ $email }}">
            <input type="text" class="form-control" id="email" placeholder="Email" name="email" value="{{ $email }}"
                   disabled><br>

            <label for="name">{{ trans('user::names.name') }}</label>
            <input type="text" class="form-control" id="name" placeholder="{{ trans('user::names.name') }}" name="name"
                   value="{{ old('name') }}"><br>

            <label for="surname">{{ trans('user::names.surname') }}</label>
            <input type="text" class="form-control" id="name" placeholder="{{ trans('user::names.surname') }}"
                   name="surname" value="{{ old('surname') }}"><br>


            <div class="input-field col s12">
                <select id="gender" name="gender">
                    <option value="1">{{ trans('user::names.gender.men') }}</option>
                    <option value="0">{{ trans('user::names.gender.women') }}</option>
                </select>
                <label for="gender">{{ trans('user::names.gender') }}</label>

            </div>

            <div class="row">

                <div class="input-field col s12">
                    <input id="login" name="login" type="text">
                    <label for="login">{{ trans('user::names.login') }}</label>
                </div>

                <div class="input-field col s12">
                    <input id="password" name="password" type="password">
                    <label for="password">{{ trans('user::names.password') }}</label>
                </div>

            </div>

            <button type="submit" class="btn btn-default">{{ trans('user::names.register') }}</button>
        </form>
    </div>
@stop