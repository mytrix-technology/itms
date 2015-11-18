@extends(Config::get('adminlte::views.master'))

@section('content')
	<div class="row">
		@if (Sentry::check())
			@if($currentUser->hasAccess('view-users-list'))
				<div class="col-xs-6 col-lg-2" align="center">
					<a href="{{ URL::route('listUsers') }}"><img src="{{ asset("images/users.png") }}"></a>
					<p>{{ trans('syntara::navigation.users') }}</p>
				</div>
			@endif
			
			@if($currentUser->hasAccess('groups-management'))
				<div class="col-xs-6 col-lg-2" align="center">
					<a href="{{ URL::route('listGroups') }}"><img src="{{ asset("images/group.png") }}"></a>
					<p>{{ trans('syntara::navigation.groups') }}</p>
				</div>
			@endif
			
			@if($currentUser->hasAccess('permissions-management'))
				<div class="col-xs-6 col-lg-2" align="center">
					<a href="{{ URL::route('listPermissions') }}"><img src="{{ asset("images/permission.png") }}"></a>
					<p>{{ trans('syntara::navigation.permissions') }}</p>
				</div>
			@endif
			
			@if($currentUser->hasAccess('view-weeklymeeting-list'))
				<div class="col-xs-6 col-lg-2" align="center">
					<a href="{{ URL::route('listWeeklyMeetings') }}"><img src="{{ asset("images/setting.png") }}"></a>
					<p>Weekly Meeting</p>
				</div>
			@endif
		@endif
	</div>
@stop