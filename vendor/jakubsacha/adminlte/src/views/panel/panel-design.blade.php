@extends(Config::get('adminlte::views.master'))

@section('content')
	<div class="row">
		@if (Sentry::check())
			@if($currentUser->hasAccess('view-design-list'))
				<div class="col-xs-6 col-lg-2" align="center">
					<a href="{{ URL::route('listDesigns') }}"><img src="{{ asset("images/mockup-design.png") }}"></a>
					<p>Mockup Application</p>
				</div>
			@endif
			
			@if($currentUser->hasAccess('view-testing-list'))
				<div class="col-xs-6 col-lg-2" align="center">
					<a href="{{ URL::route('listTestings') }}"><img src="{{ asset("images/sit.png") }}"></a>
					<p>Software Integrated Test</p>
				</div>
			@endif
		@endif
	</div>
@stop