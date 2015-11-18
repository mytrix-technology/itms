<table id="example" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th rowspan="2" style="text-align: center;">#</th>
            <th rowspan="2" style="text-align: center;">Training Name</th>
            <th rowspan="2" style="text-align: center;">Date</th>
            <th rowspan="2" style="text-align: center;">Trainer</th>
            <th rowspan="2" style="text-align: center;">Participants</th>
            <th rowspan="2" style="text-align: center;">Time</th>
            <th rowspan="2" style="text-align: center;">File</th>
            <th rowspan="2" style="text-align: center;">Note</th>
            <th colspan="2" style="text-align: center;">Created</th>
            <th rowspan="2">Action</th>
        </tr>
        <tr>
            <th>User</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @if ($weeklymeetings->count())
        @foreach ($weeklymeetings as $weeklymeeting)
        
        <tr>
            <td class="hidden-xs" style="text-align: center;"></td>
            <td>&nbsp;{{ $weeklymeeting->getWeeklyMeetingSubject() }}</td>
            <td>&nbsp;{{ $weeklymeeting->getWeeklyMeetingDate() }}</td>
            <td>&nbsp;{{ $weeklymeeting->getWeeklyMeetingTrainer() }}</td>
            <td>&nbsp;{{ $weeklymeeting->getWeeklyMeetingUser() }} Person</td>
            <td>&nbsp;{{ $weeklymeeting->getWeeklyMeetingTime() }} Minutes</td>
            <td>&nbsp;<a href="{{ URL::route('downloadWeeklyMeetingFiles', $weeklymeeting->id) }}">{{ $weeklymeeting->getWeeklyMeetingFile() }}</td>
            <td>&nbsp;{{ $weeklymeeting->getWeeklyMeetingNote() }}</td>
            <td>&nbsp;{{ $weeklymeeting->getUserCreated() }}</td>
            <td>&nbsp;{{ $weeklymeeting->getCreatedAt() }}</td>
            <td class="visible-lg">
                <!-- Edit vendor -->
                <a class="fa fa-edit" href="{{ URL::route('showWeeklyMeeting', $weeklymeeting->getId()) }}" title="Edit"></a>
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