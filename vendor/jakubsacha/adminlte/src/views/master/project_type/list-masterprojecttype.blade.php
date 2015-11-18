<table id="example" class="display responsive nowrap" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th class="col-lg-1 hidden-xs" style="text-align: center;">#</th>
            <th class="col-lg-1">Name</th>
            <th class="col-lg-1">Description</th>
            <th class="col-lg-1">Activated</th>
            <th class="col-lg-1 hidden-xs">Action</th>
        </tr>
    </thead>
    <tbody>
        @if ($masterprojecttypes->count())
        @foreach ($masterprojecttypes as $masterprojecttype)
        
        <tr>
            <td class="hidden-xs" style="text-align: center;"></td>
            <td>&nbsp;{{ $masterprojecttype->getNameProjectType() }}</td>
            <td>&nbsp;{{ $masterprojecttype->getDescProjectType() }}</td>
            <td>&nbsp;
                @if($masterprojecttype->getActivated() == 1)
                    {{ "Yes" }}
                @else
                    {{ "No" }}
                @endif
            </td>
            <td class="visible-lg">
                <!-- Edit vendor -->
                @if($masterprojecttype->getActivated() == 0)
                    {{ Form::open(array('method'=>'POST', 'route'=>array('activeMasterProjectType', $masterprojecttype->getId()), 'class' => 'pull-left')) }}
                    <input type="image" name="detailBtn" id="detailBtn" title="Active" src="{{ asset("images/accept.png") }}" />
                    {{ Form::close() }}&nbsp;

                    <a class="btn btn-sm btn-info" href="{{ URL::route('showMasterProjectType', $masterprojecttype->getId()) }}">Edit</a>
                    
                @else
                    {{ Form::open(array('method'=>'POST', 'route'=>array('nonactiveMasterProjectType', $masterprojecttype->getId()), 'class' => 'pull-left')) }}
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