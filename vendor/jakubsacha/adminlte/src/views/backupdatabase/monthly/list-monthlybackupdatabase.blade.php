<table id="example" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th rowspan="2" style="text-align: center;">#</th>
            <th rowspan="2">Master DB</th>
            <th rowspan="2">Period</th>
            <th colspan="3" style="text-align: center;">Safe into Storage/Brankas</th>
            <th colspan="3" style="text-align: center;">Backup</th>
            <th rowspan="2">Remark</th>
            <th rowspan="2">Status</th>
            <th rowspan="2">Action</th>
        </tr>
        <tr>
            <th>Head IT Dev</th>
            <th>Receiver Date</th>
            <th>Approve Saving</th>
            <th>User</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    @if ($monthlyBackupDBs->count())
        @foreach ($monthlyBackupDBs as $monthlyBackupDB)

            <tr>
                <td class="hidden-xs" style="text-align: center;"></td>
                <td>&nbsp;{{ $monthlyBackupDB->getMasterDB() }}</td>
                <td>&nbsp;{{ $monthlyBackupDB->getPeriod() }}</td>
                <td>&nbsp;
                    @if($monthlyBackupDB->user_updated != null)
                        {{ $monthlyBackupDB->getUserUpdated() }}
                    @endif
                </td>
                <td>&nbsp;{{ $monthlyBackupDB->getReceiverDate() }}</td>
                <td>&nbsp;
                    @if($monthlyBackupDB->status_activated == 1)
                        {{ "The Backup Database are saving into storage" }}
                    @else
                        {{ Form::open(array('method'=>'POST', 'route'=>array('approveITDHeadMonthlyBackupDB', $monthlyBackupDB->id), 'class' => 'pull-left')) }}
                        <input type="image" name="detailBtn" id="detailBtn" title="Safe into Storage" src="{{ asset("images/accept.png") }}" />
                        {{ Form::close() }}
                    @endif
                </td>
                <td>&nbsp;{{ $monthlyBackupDB->getUserBackup() }}</td>
                <td>&nbsp;{{ $monthlyBackupDB->getBackupDate() }}</td>
                <td>&nbsp;
                    @if($monthlyBackupDB->id_master_status == 19)
                        {{ "Success" }}
                    @elseif($monthlyBackupDB->id_master_status == 20)
                        {{ "Failed" }}
                    @endif
                </td>
                <td>&nbsp;{{ $monthlyBackupDB->getRemark() }}</td>
                <td>&nbsp;
                    @if($monthlyBackupDB->status_activated == 1)
                        {{ "Close" }}
                    @else
                        {{ "Open" }}
                    @endif
                </td>
                <td class="visible-lg">
                    @if($monthlyBackupDB->status_activated == 1)
                        {{ "Backup Database is Finished" }}
                    @else
                        <!-- Edit vendor -->
                        <a class="fa fa-edit" href="{{ URL::route('showMonthlyBackupDB', $monthlyBackupDB->getId()) }}" title="Edit"></a>
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