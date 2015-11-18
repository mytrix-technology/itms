<table id="example" class="display responsive nowrap" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th class="col-lg-1 hidden-xs" style="text-align: center;">#</th>
            <th class="col-lg-1">Group</th>
            <th class="col-lg-1">Nama Status</th>
            <th class="col-lg-1">Deskripsi Status</th>
            <th class="col-lg-1">Activated</th>
            <th class="col-lg-1 hidden-xs">Action</th>
        </tr>
    </thead>
    <tbody>
        @if ($masterstatuss->count())
        @foreach ($masterstatuss as $masterstatus)
        
        <tr>
            <td class="hidden-xs" style="text-align: center;"></td>
            <td>&nbsp;{{ $masterstatus->getGroup() }}</td>
            <td>&nbsp;{{ $masterstatus->getStatusName() }}</td>
            <td>&nbsp;{{ $masterstatus->getStatusDesc() }}</td>
            <td>&nbsp;
                @if($masterstatus->getActivated() == 1)
                    {{ "Yes" }}
                @else
                    {{ "No" }}
                @endif
            </td>
            <td class="visible-lg">
                <!-- Edit Master Status -->
                @if($masterstatus->getActivated() == 0)
                    {{ Form::open(array('method'=>'POST', 'route'=>array('activeMasterStatus', $masterstatus->getId()), 'class' => 'pull-left')) }}
                    <input type="image" name="detailBtn" id="detailBtn" title="Active" src="{{ asset("images/accept.png") }}" />
                    {{ Form::close() }}&nbsp;

                    <a class="btn btn-sm btn-info" href="{{ URL::route('showMasterStatus', $masterstatus->getId()) }}">Edit</a>
                    
                @else
                    {{ Form::open(array('method'=>'POST', 'route'=>array('nonactiveMasterStatus', $masterstatus->getId()), 'class' => 'pull-left')) }}
                    <input type="image" name="detailBtn" id="detailBtn" title="Non Active" src="{{ asset("images/cancel.png") }}" />
                    {{ Form::close() }}
                @endif

            </td>
            
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