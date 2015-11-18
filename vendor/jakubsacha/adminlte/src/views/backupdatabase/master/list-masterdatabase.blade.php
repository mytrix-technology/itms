<table id="example" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th class="col-lg-1 hidden-xs" style="text-align: center;">#</th>
            <th class="col-lg-1">Server Name</th>
            <th class="col-lg-1">Database Name</th>
            <th class="col-lg-1">Activated</th>
            <th class="col-lg-1 hidden-xs">Action</th>
        </tr>
    </thead>
    <tbody>
        @if ($masterDBs->count())
        @foreach ($masterDBs as $masterDB)
        
        <tr>
            <td class="hidden-xs" style="text-align: center;"></td>
            <td>&nbsp;{{ $masterDB->getServerName() }}</td>
            <td>&nbsp;{{ $masterDB->getDatabaseName() }}</td>
            <td>&nbsp;
                @if($masterDB->getStatus() == 1)
                    {{ "Yes" }}
                @else
                    {{ "No" }}
                @endif
            </td>
            <td class="visible-lg">
                @if($masterDB->getStatus() == 0)
                    <a class="fa fa-edit" href="{{ URL::route('showMasterDB', $masterDB->getId()) }}" title="Edit"></a>
                    {{ Form::open(array('method'=>'POST', 'route'=>array('activeMasterDB', $masterDB->getId()), 'class' => 'pull-right')) }}
                    <input type="image" name="detailBtn" id="detailBtn" title="Active" src="{{ asset("images/accept.png") }}" />
                    {{ Form::close() }}
                @else
                    {{ Form::open(array('method'=>'POST', 'route'=>array('nonactiveMasterDB', $masterDB->getId()), 'class' => 'pull-right')) }}
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