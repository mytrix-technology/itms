<table id="example" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="col-lg-1 hidden-xs" style="text-align: center;">#</th>
            <th class="col-lg-1">Subject Tasklist</th>
            <th class="col-lg-1">Project Reference</th>
            <th class="col-lg-1">Create Date</th>
            <th class="col-lg-1">Job</th>
            <th class="col-lg-1">Description</th>
            <th class="col-lg-1">Target Finish</th>
            <th class="col-lg-1">Actual Finish Date</th>
            <th class="col-lg-1">Status</th>
            <th class="col-lg-1">Note</th>
            <th class="col-lg-1 hidden-xs">Action</th>
        </tr>
    </thead>
    <tbody>
        @if ($dailyreports->count())
        @foreach ($dailyreports as $dailyreport)
        @if ($dailyreport->tasklist->assignment_from == Sentry::getUser()->id || $dailyreport->tasklist->assignment_to == Sentry::getUser()->id)
        
        <tr>
            <td class="hidden-xs" style="text-align: center;"></td>
            <td>&nbsp;{{ $dailyreport->getSubjectTasklist() }}</td>
            <td>&nbsp;{{ $dailyreport->getProjectReference() }}</td>
            <td>&nbsp;{{ $dailyreport->getCreateDate() }}</td>
            <td>&nbsp;{{ $dailyreport->getJob() }}</td>
            <td>&nbsp;{{ $dailyreport->getDescription() }}</td>
            <td>&nbsp;{{ $dailyreport->getTargetFinish() }}</td>
            <td>&nbsp;{{ $dailyreport->getActualFinishDate() }}</td>
            <td>&nbsp;{{ $dailyreport->getStatusDailyReport() }}</td>
            <td>&nbsp;{{ $dailyreport->getNote() }}</td>
            <td class="visible-lg">
                @if($dailyreport->getStatusDailyReport() != 'close')
                    <?php $today = date("Y-m-d");
                        $remind = date("Y-m-d", strtotime('-2 days', strtotime($dailyreport->target_finish))); ?>
                    @if($today < $remind)
                        <i class="fa fa-circle text-success"></i> On Progress
                    @elseif($today < $dailyreport->getTargetFinish())
                        <i class="fa fa-circle text-warning"></i> Warning
                    @elseif($today > $dailyreport->getTargetFinish())
                        <i class="fa fa-circle text-danger"></i> Expired
                    @endif
                    <!-- Edit vendor -->
                    <a class="btn btn-sm btn-info" href="{{ URL::route('showDailyReport', $dailyreport->getId()) }}">Edit</a>
                @else
                    {{ "Daily Report is Closed / Finished"}}
                @endif
            </td>
            
        </tr>
        @endif
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