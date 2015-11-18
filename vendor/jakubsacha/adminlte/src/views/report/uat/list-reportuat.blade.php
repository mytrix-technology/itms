<table id="example" class="display responsive nowrap" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th rowspan="2" style="text-align: center;">#</th>
            <th rowspan="2">Sequence</th>
            <th rowspan="2">Project Name</th>
            <th colspan="6" style="text-align: center;">User Accept Test</th>
            <th colspan="2" style="text-align: center;">Created</th>
        </tr>
        <tr>
            <th>Target</th>
            <th>Actual Date</th>
            <th>User</th>
            <th>Note</th>
            <th>Revision</th>
            <th>File</th>
            <th>User</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
    @if ($reportuats->count())
        @foreach ($reportuats as $reportuat)

            <tr>
                <td class="hidden-xs" style="text-align: center;"></td>
                <td>&nbsp;{{ $reportuat->getSequence() }}</td>
                <td>&nbsp;{{ $reportuat->getProjectName() }}</td>
                <td>&nbsp;{{ $reportuat->getUatTarget() }}</td>
                <td>&nbsp;{{ $reportuat->getUatActualDate() }}</td>
                <td>&nbsp;{{ $reportuat->getUatUser() }}</td>
                <td>&nbsp;{{ $reportuat->getUatNote() }}</td>
                <td>&nbsp;{{ $reportuat->getUatRevision() }}</td>
                <td>&nbsp;<a href="{{ URL::route('downloadUatFiles', $reportuat->id) }}">{{ $reportuat->getUatFile() }}</td>
                <td>&nbsp;{{ $reportuat->getUserCreated() }}</td>
                <td>&nbsp;{{ $reportuat->getCreatedAt() }}</td>
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