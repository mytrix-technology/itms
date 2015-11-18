<table id="example" class="display responsive nowrap" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th rowspan="2" style="text-align: center;">#</th>
            <th rowspan="2">Project Name</th>
            <th rowspan="2">Trainer</th>
            <th rowspan="2">Actual Date</th>
            <th rowspan="2">File</th>
            <th rowspan="2">Target</th>
            <th colspan="2" style="text-align: center;">Updated</th>
        </tr>
        <tr>
            <th>User</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
    @if ($reporttrainings->count())
        @foreach ($reporttrainings as $reporttraining)

            <tr>
                <td class="hidden-xs" style="text-align: center;"></td>
                <td>&nbsp;{{ $reporttraining->getNameProject() }}</td>
                <td>&nbsp;
                    @if($reporttraining->trainer != null)
                        {{ $reporttraining->getTrainer() }}
                    @endif
                </td>
                <td>&nbsp;{{ $reporttraining->getTrainingActualDate() }}</td>
                <td>&nbsp;<a href="{{ URL::route('downloadTrainingFiles', $reporttraining->id) }}">{{ $reporttraining->getTrainingFile() }}</td>
                <td>&nbsp;{{ $reporttraining->getTrainingTarget() }}</td>
                <td>&nbsp;
                    @if($reporttraining->user_updated != null)
                        {{ $reporttraining->getUserUpdated() }}
                    @endif
                </td>
                <td>&nbsp;{{ $reporttraining->getUpdatedAt() }}</td>
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