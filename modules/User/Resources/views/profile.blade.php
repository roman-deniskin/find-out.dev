@extends('layouts.master')

@section('title') Профиль {{ $account->login }} @endsection
@section('description') Find-Out meta-description @endsection
@section('keywords') Find-Out meta-keywords @endsection

@section('content')

    <div class="container">

        <h1>{{ $account->login }} ({{ $account->name.' '.$account->surname }})</h1>

        <p>
            {{ $account->email }}
        </p>

        <p>
            {{ trans('user::names.gender') }}:
            {{ $account->gender ? trans('user::names.gender.men') : trans('user::names.gender.women') }}
        </p>
    </div>
@stop