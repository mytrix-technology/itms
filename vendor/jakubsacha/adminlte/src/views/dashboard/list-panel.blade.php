@extends(Config::get('adminlte::views.master'))

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box box-warning collapsed-box">
            <div class="box-header with-border">
                <h3 class="box-title">Search</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                </div><!-- /.box-tools -->
            </div>
            <div class="box-body">
                {{ Form::open(array('url' => 'projects')) }}
                <div class="col-lg-6">
                    <div class="form-group">
                        {{ Form::label('projectNameSearch', 'Project Name') }}
                        {{ Form::text('projectNameSearch', null, array('id' => 'projectNameSearch', 'class' => 'col-lg-12 form-control')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('referenceNoSearch', 'Reference') }}
                        {{ Form::text('referenceNoSearch', null, array('id' => 'referenceNoSearch', 'class' => 'col-lg-12 form-control')) }}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        {{ Form::label('requestUserSearch', 'User Request') }}
                        {{ Form::text('requestUserSearch', null, array('id' => 'requestUserSearch', 'class' => 'col-lg-12 form-control')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('statusSearch', 'Project Status') }}
                        {{ Form::select('statusSearch', $masterstatuss, 'Choose Status', array('id' => 'statusSearch', 'class' => 'col-lg-12 form-control'))  }}
                    </div>
                </div>
                    {{ Form::submit('Search', array('class' => 'btn btn-primary', 'style' => 'margin-top: 15px;')) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">List of Application Project</h3>
                    <p class="pull-right">
                        @if($currentUser->hasAccess('create-project'))
                        <a class="btn btn-app" href="{{ URL::route('newProject') }}">
                            <i class="fa fa-plus"></i> New
                        </a>
                        @endif
                    </p>
                
            </div>
            <div class="box-body  ajax-content no-padding">
                {{ Notification::showAll() }}
                
                @if ($errors->any())
                    <div class="alert alert-error">
                        {{ implode('<br>', $errors->all()) }}
                    </div>
                @endif
                
                <table id="example" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
			    <thead>
			        <tr>
			            <th rowspan="2" style="text-align: center;">#</th>
			            <th rowspan="2">Project Name</th>
			            <th rowspan="2">Reference No</th>
			            <th colspan="2" style="text-align: center;">Request</th>
			            <th rowspan="2">Status</th>
			            <th colspan="2" style="text-align: center;">Master</th>
			            <th rowspan="2">Documentation File</th>
			            <th rowspan="2">Project Description</th>
			            <th rowspan="2">Action</th>
			        </tr>
			        <tr>
			            <th>User</th>
			            <th>Date</th>
			            <th>Application</th>
			            <th>Modul</th>
			        </tr>
			    </thead>
			    <tbody>
			        @if ($projects->count())
			        @foreach ($projects as $project)
			        <?php
			            $users = Sentry::getUser();
			            $adm = Sentry::findGroupByName('Admin');
			            $head = Sentry::findGroupByName('HeadITDev');
			            $spv = Sentry::findGroupByName('SupervisorITDev');
			            //$coord = Sentry::findGroupByName('CoordinatorITDev');
			        ?>
			        <tr>
			            <td style="text-align: center;"></td>
			            <td>&nbsp;{{ $project->getNameProject() }}</td>
			            <td>&nbsp;{{ $project->getReference() }}</td>
			            <td>&nbsp;{{ $project->getUserRequest() }}</td>
			            <td>&nbsp;{{ $project->getProjectRequestDate() }}</td>
			            <td>&nbsp;{{ $project->getStatusProject() }}</td>
			            <td>&nbsp;
			                @if($project->master_apps_id != null)
			                    {{ $project->getMasterAppsName() }}
			                @endif
			            </td>
			            <td>&nbsp;
			                @if($project->master_modul_id != null)
			                    {{ $project->getMasterModulName() }}
			                @endif
			            </td>
			            <td>&nbsp;
			            	<a href="{{ URL::route('downloadDocProjects', $project->id) }}"> {{ $project->doc_project_file }} </a>
			            </td>
			            <td>&nbsp;{{ $project->getDescProject() }}</td>
			            <td class="visible-lg">
			                @if($project->getStatusProject() == 'close')
			                    {{ "Project Closed" }}
			                @elseif($project->getStatusProject() == 'testing')
			                    <!-- Detail Project -->
			                    <p>
			                        <a class="fa fa-book pull-left" href="{{ URL::route('detailProjects', $project->getId()) }}" title="Detail"></a>
			                        <!-- Edit Project -->
			                        <a class="fa fa-edit pull-left" href="{{ URL::route('showProject', $project->getId()) }}" title="Edit"></a>
			                    </p>
			                    <p>
			                        @if ($users->inGroup($adm) || $users->inGroup($head))
			                        <!-- Closed the Project Status -->
			                        {{ Form::open(array('method'=>'POST', 'route'=>array('closeProject', $project->id), 'class' => 'pull-left')) }}
			                        <input type="image" name="nonactiveMasterApps" id="nonactiveMasterApps" title="Closed Project" src="{{ asset("images/cancel.png") }}" />
			                        {{ Form::close() }}
			                        @endif
			                    </p>
			                @else
			                    <p><!-- Detail Project -->
				                    <a class="fa fa-book pull-left" href="{{ URL::route('detailProjects', $project->getId()) }}" title="Detail"></a>
				                    <!-- Edit vendor -->
				                    <a class="fa fa-edit pull-left" href="{{ URL::route('showProject', $project->getId()) }}" title="Edit"></a>
			                    </p>
			                @endif
			            </td>
			        </tr>
			        @endforeach
			        @else
			            <tr><td colspan="10" align="center">
			            Record Not Found!
			            </td></tr>
			        @endif
			    </tbody>
			</table>

			<div class="box-footer">

			</div>
                
            </div>
        </div>
    </div>
</div>


@stop