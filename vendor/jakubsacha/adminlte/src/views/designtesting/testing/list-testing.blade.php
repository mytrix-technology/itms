<table id="example" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th rowspan="2" style="text-align: center;">#</th>
            <th rowspan="2">Design Application Name</th>
            <th rowspan="2">Requirement Testing</th>
            <th rowspan="2">Testing Date</th>
            <th colspan="2" style="text-align: center;">SIT</th>
            <th colspan="2" style="text-align: center;">Updated</th>
            <th rowspan="2">Action</th>
        </tr>
        <tr>
            <th>Name</th>
            <th>Status</th>
            <th>User</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @if ($testings->count())
        @foreach ($testings as $testing)
        
        <tr>
            <td class="hidden-xs" style="text-align: center;"></td>
            <td>&nbsp;{{ $testing->getNameApps() }}</td>
            <td>&nbsp;{{ $testing->getRequirementTesting() }}</td>
            <td>&nbsp;{{ $testing->getSitDate() }}</td>
            <td>&nbsp;{{ $testing->getSit() }}</td>
            <td>&nbsp;
                @if($testing->status_sit != null)
                    {{ $testing->getSitStatus() }}
                @endif
            </td>
            <td>&nbsp;
                @if($testing->user_updated != null)
                    {{ $testing->getUserUpdated() }}
                @endif
            </td>
            <td>&nbsp;{{ $testing->getUpdatedAt() }}</td>
            <td class="visible-lg">
                @if($testing->status_sit == 'close')
                    {{ "Testing is Closed" }}
                @else
                    <!-- Edit SIT -->
                    <a class="fa fa-edit" href="{{ URL::route('showTesting', $testing->getId()) }}" title="Edit"></a>
                @endif
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