<table id="example" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th rowspan="2" style="text-align: center;">#</th>
            <th rowspan="2">Subject</th>
            <th colspan="2" style="text-align: center;">Assignment</th>
            <th rowspan="2">Priority</th>
            <th rowspan="2">Create Date</th>
            <th rowspan="2">Due Date</th>
            <th rowspan="2">File</th>
            <th rowspan="2">Reference Project</th>
            <th rowspan="2">Reference Design</th>
            <th rowspan="2">Description</th>
            <th rowspan="2">Action</th>
        </tr>
        <tr>
            <th>From</th>
            <th>To</th>
        </tr>
    </thead>
    <tbody>
    @if ($reporttasklists->count())
        @foreach ($reporttasklists as $reporttasklist)
        	<tr>
                <td class="hidden-xs" style="text-align: center;"></td>
                <td>&nbsp;{{ $reporttasklist->getSubject() }}</td>
                <td>&nbsp;
                    @if($reporttasklist->assignment_from != null)
                        {{ $reporttasklist->getAssignmentFrom() }}
                    @endif
                </td>
                <td>&nbsp;
                    @if($reporttasklist->assignment_to != null)
                        {{ $reporttasklist->getAssignmentTo() }}
                    @endif
                </td>
                <td>&nbsp;{{ $reporttasklist->getPriority() }}</td>
                <td>&nbsp;{{ $reporttasklist->getCreatedAt() }}</td>
                <td>&nbsp;{{ $reporttasklist->getDueDate() }}</td>
                <td>&nbsp;
                	<a href="{{ URL::route('downloadTasks', $reporttasklist->id) }}">{{ $reporttasklist->upload_file }}</a>
                </td>
                <td>&nbsp;
                    @if($reporttasklist->reference != null)
                        {{ $reporttasklist->getReference() }}
                    @endif
                </td>
                <td>&nbsp;
                    @if($reporttasklist->reference_design != null)
                        {{ $reporttasklist->getReferenceDesign() }}
                    @endif
                </td>
                <td>&nbsp;{{ $reporttasklist->getDescTasklist() }}</td>
                <td>&nbsp;
                    <p>
	                    {{ Form::open(array('method'=>'POST', 'route'=>array('detailTasks', $reporttasklist->id), 'class' => 'pull-left')) }}
	                    <input type="image" name="detailBtn" id="detailBtn" title="Detail Task" src="{{ asset("images/detail-icon1.png") }}" />
	                    {{ Form::close() }}
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