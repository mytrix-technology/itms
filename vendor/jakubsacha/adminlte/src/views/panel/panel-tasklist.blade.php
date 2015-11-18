@extends(Config::get('adminlte::views.master'))

@section('content')
	<div class="row">
		@if (Sentry::check())
			@if($currentUser->hasAccess('view-task-list'))
				<div class="col-xs-6 col-lg-2" align="center">
					<a href="{{ URL::route('listTasks') }}"><img src="{{ asset("images/task-open.png") }}"></a>
					<p>Task Open</p>
				</div>
			@endif
			
			@if($currentUser->hasAccess('view-task-list-close'))
				<div class="col-xs-6 col-lg-2" align="center">
					<a href="{{ URL::route('listTaskCloses') }}"><img src="{{ asset("images/task-close.png") }}"></a>
					<p>Task Close</p>
				</div>
			@endif
		@endif
	</div>
@stop