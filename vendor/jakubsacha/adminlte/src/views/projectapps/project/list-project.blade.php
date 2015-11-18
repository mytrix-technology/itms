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
                    <p>
                        @if ($users->inGroup($adm) || $users->inGroup($head))
                        <!-- Closed the Project Status -->
                        {{ Form::open(array('method'=>'POST', 'route'=>array('closeProject', $project->id), 'class' => 'pull-left')) }}
                        <input type="image" name="closeProject" id="closeProject" title="Closed Project" src="{{ asset("images/cancel.png") }}" />
                        {{ Form::close() }}
                        @endif
                    </p>
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
                        <input type="image" name="closeProject" id="closeProject" title="Closed Project" src="{{ asset("images/cancel.png") }}" />
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