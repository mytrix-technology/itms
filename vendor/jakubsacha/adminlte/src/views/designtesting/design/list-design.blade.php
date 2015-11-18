<table id="example" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th style="text-align: center;">#</th>
            <th>Application Name</th>
            <th>Design Version</th>
            <th>Design File</th>
            <th>Description</th>
            <th>Rule</th>
            <th>Remarks</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if ($designs->count())
        @foreach ($designs as $design)
        
        <tr>
            <td class="hidden-xs" style="text-align: center;"></td>
            <td>&nbsp;{{ $design->getNameApps() }}</td>
            <td>&nbsp;{{ $design->getDesignVersion() }}</td>
            <td>&nbsp;<a href="{{ URL::route('downloadTables', $design->id) }}">{{ $design->getDesignTable() }}</a></td>
            <td>&nbsp;{{ $design->getDescDesignTable() }}</td>
            <td>&nbsp;{{ $design->getRule() }}</td>
            <td>&nbsp;{{ $design->getRemark() }}</td>
            <td class="visible-lg">
                <!-- Edit vendor -->
                <a class="fa fa-edit" href="{{ URL::route('showDesign', $design->getId()) }}" title="Edit"></a>
            </td>
        </tr>
        @endforeach
        @else
            <tr><td colspan="10" align="center">
            Record Not Found !!!
            </td></tr>
        @endif
    </tbody>
</table>

<div class="box-footer">

</div>