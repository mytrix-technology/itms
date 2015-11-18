<table id="example" class="display responsive nowrap" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th rowspan="2" style="text-align: center;">#</th>
            <th rowspan="2">Design Application Name</th>
            <th rowspan="2">Testing Name</th>
            <th rowspan="2">Testing Date</th>
            <th rowspan="2">Testing Status</th>
            <th rowspan="2">Requirement Testing</th>
            <th colspan="2" style="text-align: center;">Updated</th>
        </tr>
        <tr>
            <th>User</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
    @if ($reportsits->count())
        @foreach ($reportsits as $reportsit)
            <tr>
                <td class="hidden-xs" style="text-align: center;"></td>
                <td>&nbsp;{{ $reportsit->getNameApps() }}</td>
                <td>&nbsp;{{ $reportsit->getSit() }}</td>
                <td>&nbsp;{{ $reportsit->getSitDate() }}</td>
                <td>&nbsp;
                    @if($reportsit->status_sit != null)
                        {{ $reportsit->getSitStatus() }}
                    @endif
                </td>
                <td>&nbsp;{{ $reportsit->getRequirementTesting() }}</td>
                <td>&nbsp;
                    @if($reportsit->user_updated != null)
                        {{ $reportsit->getUserUpdated() }}
                    @endif
                </td>
                <td>&nbsp;{{ $reportsit->getUpdatedAt() }}</td>
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