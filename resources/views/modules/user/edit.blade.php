@extends('user::layouts.master')

@section('content')

    <h1>Hello World</h1>

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

    <form role="form" method="post" action="{{ url('user/profile/update') }}">
        {!! csrf_field() !!}

        <label for="email">Name</label>
        <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{ $account->name }}"><br>

        <label for="email">Surname</label>
        <input type="text" class="form-control" id="name" placeholder="Surname" name="surname" value="{{ $account->surname }}"><br>

        <label for="gender">Gender</label>
        <select name="gender" id="gender">
            <option value="1">Men</option>
            <option value="0" {{  ($account->gender != 1) ? 'selected' : null }}>Women</option>
        </select>

        <br>

        <button type="submit" class="btn btn-default">save</button>
    </form>

@stop