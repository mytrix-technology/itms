@extends(Config::get('adminlte::views.master'))

@section('content')
	<div class="row">
		@if (Sentry::check())
			@if($currentUser->hasAccess('view-project-list'))
				<div class="col-xs-6 col-lg-2" align="center">
					<a href="{{ URL::route('listProjects') }}"><img src="{{ asset("images/project.png") }}"></a>
					<p>Request Project</p>
				</div>
			@endif
			
			@if($currentUser->hasAccess('view-assesment-list'))
				<div class="col-xs-6 col-lg-2" align="center">
					<a href="{{ URL::route('listAssesments') }}"><img src="{{ asset("images/users.png") }}"></a>
					<p>Assesment</p>
				</div>
			@endif
			
			@if($currentUser->hasAccess('view-training-list'))
				<div class="col-xs-6 col-lg-2" align="center">
					<a href="{{ URL::route('listTrainings') }}"><img src="{{ asset("images/training.png") }}"></a>
					<p>Training</p>
				</div>
			@endif
			
			@if($currentUser->hasAccess('view-uat-list'))
				<div class="col-xs-6 col-lg-2" align="center">
					<a href="{{ URL::route('listUats') }}"><img src="{{ asset("images/uat.png") }}"></a>
					<p>User Accept Test</p>
				</div>
			@endif
			
			@if($currentUser->hasAccess('view-updateapps-list'))
				<div class="col-xs-6 col-lg-2" align="center">
					<a href="{{ URL::route('listUpdateAppss') }}"><img src="{{ asset("images/apps-update.png") }}"></a>
					<p>Application Update</p>
				</div>
			@endif
		@endif
	</div>
@stop