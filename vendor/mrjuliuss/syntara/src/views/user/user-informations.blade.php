<label>{{ trans('syntara::users.registration') }} : </label> {{ $user->created_at }}<br />
<label>{{ trans('syntara::users.last-update') }} : </label> {{ $user->updated_at }}<br />
<label>{{ trans('syntara::users.last-login') }} : </label> {{ $user->last_login }}<br />
<label>{{ trans('syntara::users.ip') }} : </label> {{ $throttle->ip_address }}<br />
<label>{{ trans('syntara::users.banned-at') }} : </label> {{ isset($throttle->banned_at) ? $throttle->banned_at : 'none' }}<br />
<label>Suspended at : </label> {{ isset($throttle->suspended_at) ? $throttle->suspended_at : 'none' }}<br />