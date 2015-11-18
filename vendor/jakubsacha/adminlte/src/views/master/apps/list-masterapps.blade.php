<table id="example" class="display responsive nowrap" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th class="col-lg-1 hidden-xs" style="text-align: center;">#</th>
            <th class="col-lg-1">Name</th>
            <th class="col-lg-1">Development By</th>
            <th class="col-lg-1">Version</th>
            <th class="col-lg-1">Activated</th>
            <th class="col-lg-1">Action</th>
            <th class="col-lg-1">Build Date</th>
            <th class="col-lg-1">Description</th>
            <th class="col-lg-1">Note</th>
            
        </tr>
    </thead>
    <tbody>
        @if ($masterappss->count())
        @foreach ($masterappss as $masterapps)
        
        <tr>
            <td class="hidden-xs" style="text-align: center;"></td>
            <td>&nbsp;{{ $masterapps->getNameApps() }}</td>
            <td>&nbsp;{{ $masterapps->user->username }}</td>
            <td>&nbsp;{{ $masterapps->getVersion() }}</td>
            <td>&nbsp;
                @if($masterapps->getActivated() == 1)
                    {{ "Yes" }}
                @else
                    {{ "No" }}
                @endif
            </td>
            <td class="visible-lg">
                <!-- Edit vendor -->
                @if($masterapps->getActivated() == 0)
                    {{ Form::open(array('method'=>'POST', 'route'=>array('activeMasterApps', $masterapps->getId()), 'class' => 'pull-left')) }}
                    <input type="image" name="activeMasterApps" id="activeMasterApps" title="Active" src="{{ asset("images/accept.png") }}" />
                    {{ Form::close() }}
                    &nbsp;
                    <a class="fa fa-edit" href="{{ URL::route('showMasterApps', $masterapps->getId()) }}" title="Edit"></a>
                @else
                    {{ Form::open(array('method'=>'POST', 'route'=>array('nonactiveMasterApps', $masterapps->getId()), 'class' => 'pull-left')) }}
                    <input type="image" name="nonactiveMasterApps" id="nonactiveMasterApps" title="Non Active" src="{{ asset("images/cancel.png") }}" />
                    {{ Form::close() }}
                @endif
            </td>
            <td>&nbsp;{{ $masterapps->getBuildDate() }}</td>
            <td>&nbsp;{{ $masterapps->getDescApps() }}</td>
            <td>&nbsp;{{ $masterapps->getNote() }}</td>
        </tr>
        @endforeach
        @else
            <tr><td colspan="10" align="center">
            No Record Found !!!
            </td></tr>
        @endif
    </tbody>
</table>

<div class="box-footer">

</div>