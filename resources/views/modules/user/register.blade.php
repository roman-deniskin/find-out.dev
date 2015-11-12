@extends('user::layouts.master')

@section('content')

    <h1>Registration</h1>

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


    <form class="form-horizontal" role="form" method="POST" action="{{ url('/registration') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <label>E-mail:<br>
            <input type="text" name="email" value="{{ old('email') }}" />
        </label>

        <br>

        <label>Login:<br>
            <input type="text" name="login" value="{{ old('login') }}" />
        </label>

        <br>

        <label>Pass:<br>
            <input type="text" name="password" />
        </label>

        <input type="submit" value="Reg" />

    </form>


@stop