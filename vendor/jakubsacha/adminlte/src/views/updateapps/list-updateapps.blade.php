<table id="example" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th rowspan="2" style="text-align: center;">#</th>
            <th rowspan="2">Project</th>
            <th colspan="2" style="text-align: center;">Request</th>
            <th rowspan="2">Filename Update</th>
            <th colspan="2" style="text-align: center;">Change in</th>
            <th rowspan="2">Remark</th>
            <th rowspan="2">Version</th>
            <th rowspan="2">Manual Book</th>
            <th colspan="2" style="text-align: center;">Created</th>
            <th rowspan="2">Action</th>
        </tr>
        <tr>
            <th>User</th>
            <th>Date</th>
            <th>Database</th>
            <th>Application</th>
            <th>User</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @if ($updateappss->count())
        @foreach ($updateappss as $updateapps)
        
        <tr>
            <td class="dataTables_empty" style="text-align: center;"></td>
            <td>&nbsp;{{ $updateapps->getProject() }}</td>
            <td>&nbsp;{{ $updateapps->getUserRequest() }}</td>
            <td>&nbsp;{{ $updateapps->getRequestDate() }}</td>
            <td>&nbsp;{{ $updateapps->getFilenameUpdate() }}</td>
            <td>&nbsp;{{ $updateapps->getDatabaseChange() }}</td>
            <td>&nbsp;{{ $updateapps->getAppsChange() }}</td>
            <td>&nbsp;{{ $updateapps->getRemark() }}</td>
            <td>&nbsp;{{ $updateapps->getAppsVersion() }}</td>
            <td>&nbsp;<a href="{{ URL::route('downloadManualBooks', $updateapps->id) }}">{{ $updateapps->getManualBookFile() }}</td>
            <td>&nbsp;{{ $updateapps->getUserCreated() }}</td>
            <td>&nbsp;{{ $updateapps->getCreatedAt() }}</td>
            <td class="visible-lg">
                @if($updateapps->getMasterStatus() == 'open')
                	{{ "New Application Update" }}
                    <!-- Edit Update Application -->
                    <p>
	                    <a class="fa fa-edit" href="{{ URL::route('showUpdateApps', $updateapps->getId()) }}" title="Edit"></a>
                    
	                    <!-- Approve/Reject Update Application -->
	                    {{ Form::open(array('method'=>'POST', 'route'=>array('approveUpdateApps', $updateapps->id), 'class' => 'pull-left')) }}
	                    <input type="image" name="detailBtn" id="detailBtn" title="Approve" src="{{ asset("images/accept.png") }}" />
	                    {{ Form::close() }}

	                    {{ Form::open(array('method'=>'DELETE', 'route'=>array('rejectUpdateApps', $updateapps->id), 'class' => 'pull-left')) }}
	                    <input type="image" name="detailBtn" id="detailBtn" title="Reject" src="{{ asset("images/cancel.png") }}" />
	                    {{ Form::close() }}
                    </p>
                @elseif($updateapps->getMasterStatus() == 'approve')
                    {{ "Application Update Approve" }}
                @else
                    {{ "Application Update Reject" }}
                    <p>
	                    <a class="fa fa-edit" href="{{ URL::route('showUpdateApps', $updateapps->getId()) }}" title=""></a>
	                    <!-- Approve/Reject Update Application -->
	                    {{ Form::open(array('method'=>'POST', 'route'=>array('approveUpdateApps', $updateapps->id), 'class' => 'pull-left')) }}
	                    <input type="image" name="detailBtn" id="detailBtn" title="Approve" src="{{ asset("images/accept.png") }}" />
	                    {{ Form::close() }}

	                    {{ Form::open(array('method'=>'DELETE', 'route'=>array('rejectUpdateApps', $updateapps->id), 'class' => 'pull-left')) }}
	                    <input type="image" name="detailBtn" id="detailBtn" title="Reject" src="{{ asset("images/cancel.png") }}" />
	                    {{ Form::close() }}
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