<table id="example" class="display responsive nowrap" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th class="col-lg-1 hidden-xs" style="text-align: center;">#</th>
            <th class="col-lg-1">Name</th>
            <th class="col-lg-1">Application Name</th>
            <th class="col-lg-1">Activated</th>
            <th class="col-lg-1 hidden-xs">Action</th>
            <th class="col-lg-1">Description</th>
        </tr>
    </thead>
    <tbody>
        @if ($mastermoduls->count())
        @foreach ($mastermoduls as $mastermodul)
        
        <tr>
            <td class="hidden-xs" style="text-align: center;"></td>
            <td>&nbsp;{{ $mastermodul->getNameModul() }}</td>
            <td>&nbsp;{{ $mastermodul->getMasterAppsName() }}</td>
            <td>&nbsp;
                @if($mastermodul->getActivated() == 1)
                    {{ "Yes" }}
                @else
                    {{ "No" }}
                @endif
            </td>
            <td class="visible-lg">
                <!-- Edit vendor -->
                @if($mastermodul->getActivated() == 0)
                    {{ Form::open(array('method'=>'POST', 'route'=>array('activeMasterModul', $mastermodul->getId()), 'class' => 'pull-left')) }}
                    <input type="image" name="detailBtn" id="detailBtn" title="Active" src="{{ asset("images/accept.png") }}" />
                    {{ Form::close() }}
                    &nbsp;
                    <a class="fa fa-edit" href="{{ URL::route('showMasterModul', $mastermodul->getId()) }}" title=""></a>
                    
                @else
                    {{ Form::open(array('method'=>'POST', 'route'=>array('nonactiveMasterModul', $mastermodul->getId()), 'class' => 'pull-left')) }}
                    <input type="image" name="detailBtn" id="detailBtn" title="Non Active" src="{{ asset("images/cancel.png") }}" />
                    {{ Form::close() }}
                @endif
            </td>
            <td>&nbsp;{{ $mastermodul->getDescModul() }}</td>
            
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