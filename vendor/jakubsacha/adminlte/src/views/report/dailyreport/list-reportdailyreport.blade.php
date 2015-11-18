<table id="example" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th rowspan="2" style="text-align: center;">#</th>
            <th rowspan="2">Job</th>
            <th rowspan="2">Description</th>
            <th rowspan="2">Status</th>
            <th rowspan="2">Target Finish</th>
            <th rowspan="2">Note</th>
            <th colspan="2" style="text-align: center;">Created</th>
        </tr>
        <tr>
            <th>User</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
    @if ($reportdailyreports->count())
        @foreach ($reportdailyreports as $reportdailyreport)
            <tr>
                <td class="hidden-xs" style="text-align: center;"></td>
                <td>&nbsp;{{ $reportdailyreport->getJob() }}</td>
                <td>&nbsp;{{ $reportdailyreport->getDescription() }}</td>
                <td>&nbsp;{{ $reportdailyreport->getStatusDailyReport() }}</td>
                <td>&nbsp;{{ $reportdailyreport->getTargetFinish() }}</td>
                <td>&nbsp;{{ $reportdailyreport->getNote() }}</td>
                <td>&nbsp;
                    @if($reportdailyreport->user_created != null)
                        {{ $reportdailyreport->getUserCreated() }}
                    @endif
                </td>
                <td>&nbsp;{{ $reportdailyreport->getCreatedAt() }}</td>
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