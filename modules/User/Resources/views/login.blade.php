@extends('layouts.master')

@section('content')

	<h1>{{ trans('user::names.login') }}</h1>

	@if ($errors->has())
		<div class="alert alert-danger">
			{{ trans('user::messages.authorization.errors') }}

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


	<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<label>{{ trans('user::names.login') }}<br>
			<input type="text" name="login" value="{{ old('login') }}" />
		</label>

		<br>

		<label>{{ trans('user::names.password') }}<br>
			<input type="text" name="password" value="{{ old('password') }}"/>
		</label>

		<input type="submit" value="{{ trans('user::names.authorization') }}" />

	</form>


@stop