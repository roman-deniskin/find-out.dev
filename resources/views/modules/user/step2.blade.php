@extends('user::layouts.master')

@section('content')

    <h1>Hello World</h1>

    <p>
        {{ $email }}
    </p>

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

    <p>
        {{ trans('messages.PLZ_FILL_ALL_FIELDS') }}
    </p>

    <form role="form" method="post" action="{{ url('user/save') }}">
        {!! csrf_field() !!}

        <input type="hidden" class="form-control" id="email" placeholder="Email" name="email" value="{{ $email }}">

        <label for="email">Name</label>
        <input type="text" class="form-control" id="name" placeholder="Name" name="name"><br>

        <label for="email">Surname</label>
        <input type="text" class="form-control" id="name" placeholder="Surname" name="surname"><br>

        <label for="gender">Gender</label>
        <select name="gender" id="gender">
            <option value="1">Men</option>
            <option value="0">Women</option>
        </select>

        <br>

        <label for="login">Login</label>
        <input type="text" class="form-control" id="login" placeholder="Login" name="login"><br>

        <label for="password">Pass</label>
        <input type="password" class="form-control" id="password" placeholder="Password" name="password"><br>

        <button type="submit" class="btn btn-default">Отправить</button>
    </form>

@stop