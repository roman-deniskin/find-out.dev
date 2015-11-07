@extends('user::layouts.master')

@section('content')

    <h1>{{ $account->login }} ({{ $account->name.' '.$account->surname }})</h1>

    <p>
        {{ $account->email }}
    </p>

    <p>
        Пол: {{ $account->gender ? 'муж' : 'жен' }}
    </p>

@stop