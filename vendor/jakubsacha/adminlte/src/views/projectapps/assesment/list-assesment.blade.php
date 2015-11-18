<table id="example" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th rowspan="2" style="text-align: center;"></th>
            <th rowspan="2">Project Name</th>
            <th rowspan="2">Reference Number</th>
            <th colspan="3" style="text-align: center;">Assesment</th>
            <th rowspan="2">Note</th>
            <th colspan="2" style="text-align: center;">Updated</th>
            <th rowspan="2">Action</th>
        </tr>
        <tr>
            <th>Date</th>
            <th>User</th>
            <th>File</th>
            <th>User</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @if ($assesments->count())
        @foreach ($assesments as $assesment)
        
        <tr>
            <td class="hidden-xs" style="text-align: center;"></td>
            <td>&nbsp;{{ $assesment->getNameProject() }}</td>
            <td>&nbsp;{{ $assesment->getReference() }}</td>
            <td>&nbsp;{{ $assesment->getAssesmentDate() }}</td>
            <td>&nbsp;
                @if($assesment->assesment_user != null)
                    {{ $assesment->getAssesmentUser() }}
                @endif
            </td>
            <td>&nbsp;<a href="{{ URL::route('downloadAssesmentFiles', $assesment->id) }}"> {{ $assesment->getAssesmentFile() }} </a></td>
            <td>&nbsp;{{ $assesment->getAssesmentNote() }}</td>
            <td>&nbsp;
                @if($assesment->user_updated != null)
                    {{ $assesment->getUserUpdated() }}
                @endif
            </td>
            <td>&nbsp;{{ $assesment->getUpdatedAt() }}</td>
            <td class="visible-lg">
                 <!-- Edit vendor -->
                <a class="fa fa-edit" href="{{ URL::route('showAssesment', $assesment->getId()) }}" title="Edit"></a>
            </td>
        </tr>
        @endforeach
        @else
            <tr><td colspan="10" align="center">
            Record Not Found!!!
            </td></tr>
        @endif
    </tbody>
</table>

<div class="box-footer">

</div>