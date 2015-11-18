<table id="example" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th rowspan="2" style="text-align: center;">#</th>
            <th rowspan="2">Subject</th>
            <th colspan="2" style="text-align: center;">Assignment</th>
            <th rowspan="2">Priority</th>
            <th rowspan="2">Due Date</th>
            <th rowspan="2">File</th>
            <th rowspan="2">Reference Project</th>
            <th rowspan="2">Reference Design</th>
            <th rowspan="2">Action</th>
            <th rowspan="2">Description</th>
        </tr>
        <tr>
            <th>From</th>
            <th>To</th>
        </tr>
    </thead>
    <tbody>
        @if ($taskCloses->count())
        @foreach ($taskCloses as $task)
        <tr>
            <td style="text-align: center;"></td>
            <td>&nbsp;{{ $task->getSubject() }}</td>
            <td>&nbsp;
                @if($task->assignment_from != null)
                {{ $task->getAssignmentFrom() }}
                @endif
            </td>
            <td>&nbsp;
                @if($task->assignment_to != null)
                {{ $task->getAssignmentTo() }}
                @endif
            </td>
            <td>&nbsp;{{ $task->getPriority() }}</td>
            <td>&nbsp;{{ $task->getDueDate() }}</td>
            <td>&nbsp;<a href="{{ URL::route('downloadTasks', $task->id) }}">{{ $task->upload_file }}</a></td>
            <td>&nbsp;
                @if($task->reference != null)
                {{ $task->getReference() }}
                @endif
            </td>
            <td>&nbsp;
                @if($task->reference_design != null)
                {{ $task->getReferenceDesign() }}
                @endif
            </td>
            <td class="visible-lg">
                <a class="fa fa-edit" href="{{ URL::route('showTask', $task->id) }}" title="edit"></a>
            </td>
            <td>&nbsp;{{ $task->getDescTasklist() }}</td>
        </tr>
        @endforeach
        @else
        <tr><td colspan="10" align="center">
            Record Not Found !!!
        </td></tr>
        @endif
    </tbody>
</table>
<div class="box-footer">
</div>