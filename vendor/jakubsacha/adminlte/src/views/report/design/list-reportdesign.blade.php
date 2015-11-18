<table id="example" class="display responsive nowrap" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th style="text-align: center;">#</th>
            <th>Application Name</th>
            <th>Design Version</th>
            <th>Design File</th>
            <th>Description</th>
            <th>Rule</th>
            <th>Remarks</th>
            <th>User Created</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
    @if ($reportdesigns->count())
        @foreach ($reportdesigns as $reportdesign)
            <tr>
                <td class="hidden-xs" style="text-align: center;"></td>
                <td>&nbsp;{{ $reportdesign->getNameApps() }}</td>
                <td>&nbsp;{{ $reportdesign->getDesignVersion() }}</td>
                <td>&nbsp;<a href="{{ URL::route('downloadTables', $reportdesign->id) }}">{{ $reportdesign->getDesignTable() }}</a></td>
                <td>&nbsp;{{ $reportdesign->getDescDesignTable() }}</td>
                <td>&nbsp;{{ $reportdesign->getRule() }}</td>
                <td>&nbsp;{{ $reportdesign->getRemark() }}</td>
                <td>&nbsp;{{ $reportdesign->getUserCreated() }}</a></td>
                <td>&nbsp;{{ $reportdesign->getCreatedAt() }}</td>
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