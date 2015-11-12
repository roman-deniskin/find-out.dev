@if(Auth::check() === false)
    <li><a href="{{ url('/') }}">{{ trans('user::names.authorization') }}</a></li>
    <li><a href="{{ url('/') }}">{{ trans('user::names.registration') }}</a></li>
@else
    <li><a href="{{ url('/user/profile/'.Auth::getUser()->id) }}">{{ trans('user::names.profile.view') }}</a></li>
    <li><a href="{{ url('/user/profile/edit') }}">{{ trans('user::names.profile.edit') }}</a></li>
    <li><a href="{{ url('/logout') }}">{{ trans('user::names.logout') }}</a></li>
@endif


