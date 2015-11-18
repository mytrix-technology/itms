<table id="example" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th rowspan="2" style="text-align: center;">#</th>
            <th rowspan="2">Sequence</th>
            <th rowspan="2">Project Name</th>
            <th colspan="6" style="text-align: center;">User Accept Test</th>
            <th colspan="2" style="text-align: center;">Created</th>
            <th rowspan="2">Action</th>
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
        @if ($uats->count())
        @foreach ($uats as $uat)
        
        <tr>
            <td class="hidden-xs" style="text-align: center;"></td>
            <td>&nbsp;{{ $uat->getSequence() }}</td>
            <td>&nbsp;{{ $uat->getProjectName() }}</td>
            <td>&nbsp;{{ $uat->getUatTarget() }}</td>
            <td>&nbsp;{{ $uat->getUatActualDate() }}</td>
            <td>&nbsp;{{ $uat->getUatUser() }}</td>
            <td>&nbsp;{{ $uat->getUatNote() }}</td>
            <td>&nbsp;{{ $uat->getUatRevision() }}</td>
            <td>&nbsp;<a href="{{ URL::route('downloadUatFiles', $uat->id) }}">{{ $uat->getUatFile() }}</td>
            <td>&nbsp;{{ $uat->getUserCreated() }}</td>
            <td>&nbsp;{{ $uat->getCreatedAt() }}</td>
            <td class="visible-lg">
                <!-- Edit vendor -->
                <a class="fa fa-edit" href="{{ URL::route('showUat', $uat->getId()) }}" title="Edit"></a>
                
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