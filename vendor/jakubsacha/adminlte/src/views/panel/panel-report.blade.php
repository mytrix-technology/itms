@extends(Config::get('adminlte::views.master'))

@section('content')
	<div class="row">
		@if (Sentry::check())
			@if($currentUser->hasAccess('view-reportproject-list'))
				<div class="col-xs-6 col-lg-2" align="center">
					<a href="{{ URL::route('listReportProjects') }}"><img src="{{ asset("images/project.png") }}"></a>
					<p>Report Project</p>
				</div>
			@endif
			
			@if($currentUser->hasAccess('view-reportassesment-list'))
				<div class="col-xs-6 col-lg-2" align="center">
					<a href="{{ URL::route('listReportAssesments') }}"><img src="{{ asset("images/users.png") }}"></a>
					<p>Report Assesment</p>
				</div>
			@endif
			
			@if($currentUser->hasAccess('view-reportdesign-list'))
				<div class="col-xs-6 col-lg-2" align="center">
					<a href="{{ URL::route('listReportDesigns') }}"><img src="{{ asset("images/mockup-design.png") }}"></a>
					<p>Report Design</p>
				</div>
			@endif
			
			@if($currentUser->hasAccess('view-reporttasklist-list'))
				<div class="col-xs-6 col-lg-2" align="center">
					<a href="{{ URL::route('listReportTasklists') }}"><img src="{{ asset("images/task-open.png") }}"></a>
					<p>Report Tasklist</p>
				</div>
			@endif
			
			@if($currentUser->hasAccess('view-reportdailyreport-list'))
				<div class="col-xs-6 col-lg-2" align="center">
					<a href="{{ URL::route('listReportDailyReports') }}"><img src="{{ asset("images/daily-report.png") }}"></a>
					<p>Report Daily Task</p>
				</div>
			@endif

			@if($currentUser->hasAccess('view-reportsit-list'))
				<div class="col-xs-6 col-lg-2" align="center">
					<a href="{{ URL::route('listReportSits') }}"><img src="{{ asset("images/sit.png") }}"></a>
					<p>Report Software Integrated Test</p>
				</div>
			@endif
		@endif
	</div>

	<div class="row">
		@if (Sentry::check())
			@if($currentUser->hasAccess('view-reportuat-list'))
				<div class="col-xs-6 col-lg-2" align="center">
					<a href="{{ URL::route('listReportUats') }}"><img src="{{ asset("images/uat.png") }}"></a>
					<p>Report User Accept Test</p>
				</div>
			@endif
			
			@if($currentUser->hasAccess('view-reporttraining-list'))
				<div class="col-xs-6 col-lg-2" align="center">
					<a href="{{ URL::route('listReportTrainings') }}"><img src="{{ asset("images/training.png") }}"></a>
					<p>Report Training</p>
				</div>
			@endif
			
			@if($currentUser->hasAccess('view-reportupdateapps-list'))
				<div class="col-xs-6 col-lg-2" align="center">
					<a href="{{ URL::route('listReportUpdateAppss') }}"><img src="{{ asset("images/apps-update.png") }}"></a>
					<p>Report Application Update</p>
				</div>
			@endif
		@endif
	</div>
@stop