<table id="example" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th rowspan="2" style="text-align: center;">#</th>
            <th rowspan="2">Project Name</th>
            <th rowspan="2">Reference Number</th>
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
    @if ($reportprojectemails->count())
        @foreach ($reportprojectemails as $reportproject)

            <tr>
                <td class="hidden-xs" style="text-align: center;"></td>
                <td>&nbsp;{{ $reportproject->getNameProject() }}</td>
                <td>&nbsp;{{ $reportproject->getReference() }}</td>
                <td>&nbsp;{{ $reportproject->getUserRequest() }}</td>
                <td>&nbsp;{{ $reportproject->getProjectRequestDate() }}</td>
                <td>&nbsp;{{ $reportproject->getStatusProject() }}</td>
                <td>&nbsp;
	                @if($reportproject->master_apps_id != null)
	                    {{ $reportproject->getMasterAppsName() }}
	                @endif
	            </td>
	            <td>&nbsp;
	                @if($reportproject->master_modul_id != null)
	                    {{ $reportproject->getMasterModulName() }}
	                @endif
	            </td>
	            <td>&nbsp;
	            	<a href="{{ URL::route('downloadDocProjects', $reportproject->id) }}"> {{ $reportproject->doc_project_file }} </a>
	            </td>
                <td>&nbsp;{{ $reportproject->getDescProject() }}</td>
                <td class="visible-lg">
                    <p><!-- Detail Project -->
                    	<a class="fa fa-tasks" href="{{ URL::route('detailProjects', $reportproject->getId()) }}" title="Detail"></a>
                    </p>
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