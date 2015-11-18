@extends(Config::get('adminlte::views.master'))

@section('content')
	<div class="row">
		@if (Sentry::check())
			@if($currentUser->hasAccess('view-masterapps-list'))
				<div class="col-xs-6 col-lg-2" align="center">
					<a href="{{ URL::route('listMasterAppss') }}"><img src="{{ asset("images/application.png") }}"></a>
					<p>Master Application</p>
				</div>
			@endif
			
			@if($currentUser->hasAccess('view-mastermodul-list'))
				<div class="col-xs-6 col-lg-2" align="center">
					<a href="{{ URL::route('listMasterModuls') }}"><img src="{{ asset("images/modul.png") }}"></a>
					<p>Master Modul</p>
				</div>
			@endif
			
			@if($currentUser->hasAccess('view-masterprojecttype-list'))
				<div class="col-xs-6 col-lg-2" align="center">
					<a href="{{ URL::route('listMasterProjectTypes') }}"><img src="{{ asset("images/project-type.jpg") }}"></a>
					<p>Master Project Type</p>
				</div>
			@endif
			
			@if($currentUser->hasAccess('view-mastertasktype-list'))
				<div class="col-xs-6 col-lg-2" align="center">
					<a href="{{ URL::route('listMasterTaskTypes') }}"><img src="{{ asset("images/task-type.png") }}"></a>
					<p>Master Task Type</p>
				</div>
			@endif
			
			@if($currentUser->hasAccess('view-masterstatus-list'))
				<div class="col-xs-6 col-lg-2" align="center">
					<a href="{{ URL::route('listMasterStatuss') }}"><img src="{{ asset("images/status.png") }}"></a>
					<p>Master Status</p>
				</div>
			@endif
		@endif
	</div>
@stop