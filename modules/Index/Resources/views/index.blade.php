@extends('index::layouts.master')

@section('content')

    @if(Session::has('message'))
        {{ Session::get('message') }}
    @endif

    @if(\Illuminate\Support\Facades\Auth::check() == false)
        <h1>Login</h1>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <label>Login:<br>
                <input type="text" name="login" value="{{ old('login') }}"/>
            </label>

            <br>

            <label>Pass:<br>
                <input type="text" name="password" value="{{ old('password') }}"/>
            </label>

            <input type="submit" value="Login"/>

        </form>

        <hr>

        <h1>Registration</h1>

        <form class="form-horizontal" role="form" method="POST" action="{{ url('/registration') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <label>E-mail:<br>
                <input type="text" name="email" value="{{ old('email') }}"/>
            </label>

            <br>

            <input type="submit" value="Reg"/>

        </form>

        <hr>

        <div class="title"><a href="/login">Login</a></div>
        <div class="title"><a href="/registration">Registration</a></div>
    @else
        <div class="title"><a href="/logout">Logout</a></div>
    @endif

@stop