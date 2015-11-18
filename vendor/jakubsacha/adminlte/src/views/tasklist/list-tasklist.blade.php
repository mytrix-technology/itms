<table id="example" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th rowspan="2" style="text-align: center;">#</th>
            <th rowspan="2">Subject</th>
            <th colspan="2" style="text-align: center;">Assignment</th>
            <th rowspan="2">Priority</th>
            <th rowspan="2">Due Date</th>
            <th rowspan="2">File</th>
            <th colspan="2" style="text-align: center;">Reference</th>
            <th rowspan="2">Action</th>
            <th rowspan="2">Description</th>
            
        </tr>
        <tr>
            <th>From</th>
            <th>To</th>
            <th>Project</th>
            <th>Design</th>
        </tr>
    </thead>
    <tbody>
        @if ($taskOpens->count())
            @foreach ($taskOpens as $task)
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
                    @if($task->getActiveStatus() == '1')
                        @if($task->getStatusVersion() == '2' || $task->getStatusVersion() == '8')
                        {{ $task->getStatusTasklist() }}
                        <!-- Edit vendor -->
                        <p>
                            <a class="fa fa-edit" href="{{ URL::route('showTask', $task->id) }}" title="edit"></a>
                        </p>
                        @else
                        {{ $task->getStatusTasklist() }}
                        <p>
                            {{ Form::open(array('method'=>'POST', 'route'=>array('detailTasks', $task->id), 'class' => 'pull-left')) }}
                            <input type="image" name="detailBtn" id="detailBtn" title="Detail Task" src="{{ asset("images/detail-icon1.png") }}" />
                            {{ Form::close() }}&nbsp;
                            @if($task->getStatusVersion() == '1')
                                @if($task->assignment_from == Sentry::getUser()->id)
                                <a class="fa fa-edit" href="{{ URL::route('showTask', $task->id) }}" title="edit"></a>
                                @endif
                            @else
                            <a class="fa fa-edit" href="{{ URL::route('showTask', $task->id) }}" title="edit"></a>
                            @endif
                            
                        </p>
                        @endif
                    @else
                    {{ "Status is not Active." }}<br>
                    <a href="{{ URL::route('listMasterStatuss') }}">Activated</a>
                    @endif
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