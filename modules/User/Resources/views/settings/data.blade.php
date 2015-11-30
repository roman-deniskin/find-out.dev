<?php
use Modules\User\Entities\User as UserModel;
?>

@extends('layouts.master')

@section('title') {{ trans('user::settings.settings') }} @endsection

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

        @include('user::settings.tabs', ['active' => 'data'])

        <form role="form" method="post" action="{{ url('/settings/data') }}">
            {!! csrf_field() !!}

            <label for="name">{{ trans('user::names.name') }}</label>
            <input type="text" class="form-control" id="name" placeholder="{{ trans('user::names.name') }}" name="name"
                   value="{{ old($user->name) ? old($user->name) : $user->name }}">
            <br>

            <label for="surname">{{ trans('user::names.surname') }}</label>
            <input type="text" class="form-control" id="surname" placeholder="{{ trans('user::names.surname') }}"
                   name="surname" value="{{ old($user->surname) ? old($user->surname) : $user->surname }}">
            <br>

            <label for="gender">{{ trans('user::names.gender') }}</label>
            <select class="form-control" name="gender" id="gender">
                <option value="1">{{ trans('user::names.gender.men') }}</option>
                <option value="0" {{  ($user->gender != 1) ? 'selected' : null }}>{{ trans('user::names.gender.women') }}</option>
            </select>
            <br>

            <label for="date_of_birth">{{ trans('user::names.date_of_birth') }}</label> <small>{{ trans('user::names.date_of_birth_mask') }}</small>
            <input type="text" class="form-control" id="date_of_birth" placeholder="{{ trans('user::names.date_of_birth') }}" name="date_of_birth" value="{{ $user->date_of_birth }}">
            <br>

            <label for="date_of_birth_view_type">{{ trans('user::names.date_of_birth_view_type') }}</label><br>
            <select name="date_of_birth_view_type" class="form-control" id="date_of_birth_view_type">
                @foreach(UserModel::getDateViewTypes() as $key => $value)
                    <option value="{{ $key }}" {{  ($user->date_of_birth_view_type == $key) ? 'selected' : null }}>{{ $value }}</option>
                @endforeach
            </select>
            <br>

            <label for="country">{{ trans('user::names.country') }}</label>
            <input type="text" class="form-control" id="country" placeholder="{{ trans('user::names.country') }}" name="country" value="{{ $user->country }}">
            <br>

            <label for="city">{{ trans('user::names.city') }}</label>
            <input type="text" class="form-control" id="city" placeholder="{{ trans('user::names.city') }}" name="city" value="{{ $user->city }}">
            <br>

            <label for="location">{{ trans('user::names.location') }}</label>
            <input type="text" class="form-control" id="location" placeholder="{{ trans('user::names.location') }}" name="location" value="{{ $user->location }}">
            <br>

            <label for="relationship">{{ trans('user::names.relationship') }}</label><br>
                <select name="relationship" class="form-control" id="relationship">
                    @foreach(UserModel::getRelationship(Auth::user()->gender) as $key => $value)
                        <option value="{{ $key }}" {{  ($user->relationship == $key) ? 'selected' : null }}>{{ $value }}</option>
                    @endforeach
                </select>
            <br>

            <label for="status">{{ trans('user::names.status') }}</label>
            <textarea placeholder="{{ trans('user::names.status') }}" name="status" id="status" class="form-control">{{ $user->status or null}}</textarea>
            <br>

            <label for="hobby">{{ trans('user::names.hobby') }}</label>
            <textarea placeholder="{{ trans('user::names.hobby') }}" name="hobby" id="hobby" class="form-control">{{ $user->hobby or null}}</textarea>
            <br>

            <label for="activity">{{ trans('user::names.activity') }}</label>
            <textarea placeholder="{{ trans('user::names.activity') }}" name="activity" id="activity" class="form-control">{{ $user->activity or null}}</textarea>
            <br>

            <h4>{{ trans('user::names.social_networks') }}</h4>
            <hr>

            <label for="social_network_vk">{{ trans('user::names.social_network_vk') }}</label>
            <input type="text" class="form-control" id="social_network_vk" placeholder="{{ trans('user::names.social_network_vk') }}" name="social_network_vk" value="{{ $user->social_network_vk }}">
            <br>

            <label for="social_network_fb">{{ trans('user::names.social_network_fb') }}</label>
            <input type="text" class="form-control" id="social_network_fb" placeholder="{{ trans('user::names.social_network_fb') }}" name="social_network_fb" value="{{ $user->social_network_fb }}">
            <br>

            <label for="social_network_tw">{{ trans('user::names.social_network_tw') }}</label>
            <input type="text" class="form-control" id="social_network_tw" placeholder="{{ trans('user::names.social_network_tw') }}" name="social_network_tw" value="{{ $user->social_network_tw }}">
            <br>

            <label for="social_network_in">{{ trans('user::names.social_network_in') }}</label>
            <input type="text" class="form-control" id="social_network_in" placeholder="{{ trans('user::names.social_network_in') }}" name="social_network_in" value="{{ $user->social_network_in }}">
            <br>

            <label for="social_network_skype">{{ trans('user::names.social_network_skype') }}</label>
            <input type="text" class="form-control" id="social_network_skype" placeholder="{{ trans('user::names.social_network_skype') }}" name="social_network_skype" value="{{ $user->social_network_skype }}">
            <hr>

            <label for="social_homepage">{{ trans('user::names.social_homepage') }}</label>
            <input type="text" class="form-control" id="social_homepage" placeholder="{{ trans('user::names.social_homepage') }}" name="social_homepage" value="{{ $user->social_homepage }}">

            <hr>

            <button type="submit" class="btn btn-default">{{ trans('user::names.profile.save') }}</button>
        </form>

    </div>

@stop