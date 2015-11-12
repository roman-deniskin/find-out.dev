@extends('user::layouts.master')

@section('content')

    <style>
        .red{
            color: red;
        }
    </style>

    <h1>Hello World</h1>

    @if ($errors->has())
        <div class="alert alert-danger">
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

        </div>
    @endif

    <p>
        {{ trans('user::messages.PLZ_FILL_ALL_FIELDS') }}
    </p>

    <form role="form" method="post" action="{{ url('user/save') }}">
        {!! csrf_field() !!}

        <label for="email">E-mail</label>
        <input type="hidden" class="form-control" name="email" value="{{ $email }}">
        <input type="text" class="form-control" id="email" placeholder="Email" name="email" value="{{ $email }}" disabled><br>

        <label for="name">{{ trans('user::names.name') }}</label>
        <input type="text" class="form-control" id="name" placeholder="{{ trans('user::names.name') }}" name="name" value="{{ old('name') }}"><br>

        <label for="surname">{{ trans('user::names.surname') }}</label>
        <input type="text" class="form-control" id="name" placeholder="{{ trans('user::names.surname') }}" name="surname" value="{{ old('surname') }}"><br>

        <label for="gender">{{ trans('user::names.gender') }}</label>
        <select name="gender" id="gender">
            <option value="1">{{ trans('user::names.gender.men') }}</option>
            <option value="0">{{ trans('user::names.gender.women') }}</option>
        </select>

        <br>

        <label @if($errors->has('login')) class="red" @endif for="login">{{ trans('user::names.login') }}</label>
        <input type="text" class="form-control" id="login" placeholder="{{ trans('user::names.login') }}" name="login" value="{{ old('login') }}"><br>

        <label @if($errors->has('password')) class="red" @endif for="password">{{ trans('user::names.password') }}</label>



        <input type="password" class="form-control"
               id="password" placeholder="{{ trans('user::names.password') }}" name="password"><br>

        <button type="submit" class="btn btn-default">{{ trans('user::names.register') }}</button>
    </form>

@stop