@extends(Config::get('adminlte::views.master'))

@section('content')
	<div class="row">
		@if (Sentry::check())
			@if($currentUser->hasAccess('view-masterDB-list'))
				<div class="col-xs-6 col-lg-2" align="center">
					<a href="{{ URL::route('listMasterDBs') }}"><img src="{{ asset("images/database.png") }}"></a>
					<p>Master Database</p>
				</div>
			@endif
			
			@if($currentUser->hasAccess('view-monthlyBackupDB-list'))
				<div class="col-xs-6 col-lg-2" align="center">
					<a href="{{ URL::route('listMonthlyBackupDBs') }}"><img src="{{ asset("images/monthly-backup.png") }}"></a>
					<p>Monthly Backup Database</p>
				</div>
			@endif
		@endif
	</div>
@stop