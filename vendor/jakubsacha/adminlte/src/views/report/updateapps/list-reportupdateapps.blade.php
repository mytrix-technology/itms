<table id="example" class="display responsive nowrap" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th rowspan="2" style="text-align: center;">#</th>
            <th rowspan="2">Project</th>
            <th colspan="2" style="text-align: center;">Request</th>
            <th rowspan="2">Filename Update</th>
            <th rowspan="2">Action</th>
            <th colspan="2" style="text-align: center;">Change in</th>
            <th rowspan="2">Remark</th>
            <th rowspan="2">Version</th>
            <th rowspan="2">Manual Book</th>
            <th colspan="2" style="text-align: center;">Created</th>
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
    @if ($reportupdateappss->count())
        @foreach ($reportupdateappss as $reportupdateapps)

            <tr>
                <td class="hidden-xs" style="text-align: center;"></td>
                <td>&nbsp;{{ $reportupdateapps->getProject() }}</td>
                <td>&nbsp;{{ $reportupdateapps->getUserRequest() }}</td>
                <td>&nbsp;{{ $reportupdateapps->getRequestDate() }}</td>
                <td>&nbsp;{{ $reportupdateapps->getFilenameUpdate() }}</td>
                <td>
                    {{ Form::open(array('method'=>'POST', 'route'=>array('detailTasks', $reportupdateapps->id), 'class' => 'pull-left')) }}
                    <input type="image" name="detailBtn" id="detailBtn" title="Detail Task" src="{{ asset("images/detail-icon1.png") }}" />
                    {{ Form::close() }}
                </td>
                <td>&nbsp;{{ $reportupdateapps->getDatabaseChange() }}</td>
                <td>&nbsp;{{ $reportupdateapps->getAppsChange() }}</td>
                <td>&nbsp;{{ $reportupdateapps->getRemark() }}</td>
                <td>&nbsp;{{ $reportupdateapps->getAppsVersion() }}</td>
                <td>&nbsp;<a href="{{ URL::route('downloadManualBooks', $reportupdateapps->id) }}">{{ $reportupdateapps->getManualBookFile() }}</td>
                <td>&nbsp;{{ $reportupdateapps->getUserCreated() }}</td>
                <td>&nbsp;{{ $reportupdateapps->getCreatedAt() }}</td>
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