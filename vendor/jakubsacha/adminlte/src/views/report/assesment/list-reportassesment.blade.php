<table id="example" class="display responsive nowrap" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th rowspan="2" style="text-align: center;"></th>
            <th rowspan="2">Project Name</th>
            <th rowspan="2">Reference Number</th>
            <th colspan="2" style="text-align: center;">Assesment</th>
            <th rowspan="2">File</th>
            <th colspan="2" style="text-align: center;">Updated</th>
            <th rowspan="2">Note</th>
        </tr>
        <tr>
            <th>Date</th>
            <th>User</th>
            <th>User</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
    @if ($reportassesments->count())
        @foreach ($reportassesments as $reportassesment)
            <tr>
                <td class="hidden-xs" style="text-align: center;"></td>
                <td>&nbsp;{{ $reportassesment->getNameProject() }}</td>
                <td>&nbsp;{{ $reportassesment->getReference() }}</td>
                <td>&nbsp;{{ $reportassesment->getAssesmentDate() }}</td>
                <td>&nbsp;
                    @if($reportassesment->assesment_user != null)
                        {{ $reportassesment->getAssesmentUser() }}
                    @endif
                </td>
                <td>&nbsp;<a href="{{ URL::route('downloadAssesmentFiles', $reportassesment->id) }}"> {{ $reportassesment->getAssesmentFile() }} </a></td>
                <td>&nbsp;
                    @if($reportassesment->user_updated != null)
                        {{ $reportassesment->getUserUpdated() }}
                    @endif
                </td>
                <td>&nbsp;{{ $reportassesment->getUpdatedAt() }}</td>
                <td>&nbsp;{{ $reportassesment->getAssesmentNote() }}</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="10" align="center">
                Record Not Found!
            </td>
        </tr>
    @endif
    </tbody>
</table>

<div class="box-footer">

</div>