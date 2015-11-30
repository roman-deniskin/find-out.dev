<ul class="nav nav-tabs" role="tablist">

    <li {{ $active == 'index' ? 'class=active' : ''}}>
        <a href="{{ url('/settings') }}">
            {{ trans('user::settings.common') }}
        </a>
    </li>

    <li {{ $active == 'data' ? 'class=active' : ''}}>
        <a href="{{ url('/settings/data') }}">
            {{ trans('user::settings.personal_data') }}
        </a>
    </li>

    <li {{ $active == 'contacts' ? 'class=active' : ''}}>
        <a href="{{ url('/settings/contacts') }}">
            {{ trans('user::settings.contacts') }}
        </a>
    </li>

    <li {{ $active == 'privacy' ? 'class=active' : ''}}>
        <a href="{{ url('/settings/privacy') }}">
            {{ trans('user::settings.privacy') }}
        </a>
    </li>

</ul>