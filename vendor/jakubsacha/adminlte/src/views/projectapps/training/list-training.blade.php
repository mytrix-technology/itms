<table id="example" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th style="text-align: center;">#</th>
            <th>Project Name</th>
            <th>Trainer</th>
            <th>Actual Date</th>
            <th>File</th>
            <th>Target</th>
            <th>User Updated</th>
            <th>Updated At</th>
            <th>Action</th>
        </tr>
        
    </thead>
    <tbody>
        @if ($trainings->count())
        @foreach ($trainings as $training)
        
        <tr>
            <td class="hidden-xs" style="text-align: center;"></td>
            <td>&nbsp;{{ $training->getNameProject() }}</td>
            <td>&nbsp;
                @if($training->trainer != null)
                    {{ $training->getTrainer() }}
                @endif
            </td>
            <td>&nbsp;{{ $training->getTrainingActualDate() }}</td>
            <td>&nbsp;<a href="{{ URL::route('downloadTrainingFiles', $training->id) }}">{{ $training->getTrainingFile() }}</td>
            <td>&nbsp;{{ $training->getTrainingTarget() }}</td>
            <td>&nbsp;
                @if($training->user_updated != null)
                    {{ $training->getUserUpdated() }}
                @endif
            </td>
            <td>&nbsp;{{ $training->getUpdatedAt() }}</td>
            <td class="visible-lg">
                <!-- Edit vendor -->
                <a class="fa fa-edit" href="{{ URL::route('showTraining', $training->getId()) }}" title="Edit"></a>
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