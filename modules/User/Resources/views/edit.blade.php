@extends('layouts.master')

@section('title') {{ trans('user::names.profile.edit') }} {{ trans('user::names.profile.view') }} @endsection

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

        <form role="form" method="post" action="{{ url('user/profile/update') }}">
            {!! csrf_field() !!}

            <label for="name">{{ trans('user::names.name') }}</label>
            <input type="text" class="form-control" id="name" placeholder="{{ trans('user::names.name') }}" name="name"
                   value="{{ $account->name }}"><br>

            <label for="email">{{ trans('user::names.surname') }}</label>
            <input type="text" class="form-control" id="name" placeholder="{{ trans('user::names.surname') }}"
                   name="surname" value="{{ $account->surname }}"><br>

            <label for="gender">{{ trans('user::names.gender') }}</label>
            <select name="gender" id="gender">
                <option value="1">{{ trans('user::names.gender.men') }}</option>
                <option value="0" {{  ($account->gender != 1) ? 'selected' : null }}>{{ trans('user::names.gender.women') }}</option>
            </select>

            <br>

            <button type="submit" class="btn btn-default">{{ trans('user::names.profile.save') }}</button>
        </form>

    </div>

@stop