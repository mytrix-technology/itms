<table id="example" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th rowspan="2" style="text-align: center;">#</th>
            <th rowspan="2">Master DB</th>
            <th rowspan="2">Period</th>
            <th colspan="3" style="text-align: center;">Backup</th>
            <th rowspan="2">Remark</th>
            <th colspan="2" style="text-align: center;">Approval</th>
            <th rowspan="2">Receiver Date</th>
            <th rowspan="2">Status</th>
            <th rowspan="2">Action</th>
        </tr>
        <tr>
            <th>User</th>
            <th>Date</th>
            <th>Status</th>
            <th>DBA</th>
            <th>SPV IT Dev</th>
        </tr>
    </thead>
    <tbody>
        @if ($dailyBackupDBs->count())
        @foreach ($dailyBackupDBs as $dailyBackupDB)
        
        <tr>
            <td class="hidden-xs" style="text-align: center;"></td>
            <td>&nbsp;{{ $dailyBackupDB->getMasterDB() }}</td>
            <td>&nbsp;{{ $dailyBackupDB->getPeriod() }}</td>
            <td>&nbsp;{{ $dailyBackupDB->getUserBackup() }}</td>
            <td>&nbsp;{{ $dailyBackupDB->getBackupDate() }}</td>
            <td>&nbsp;
                @if($dailyBackupDB->id_master_status == 19)
                    {{ "Success" }}
                @elseif($dailyBackupDB->id_master_status == 20)
                    {{ "Failed" }}
                @endif
            </td>
            <td>&nbsp;{{ $dailyBackupDB->getRemark() }}</td>

            <td>&nbsp;
                @if($currentUser->hasAccess('approvedba-dailyBackupDB'))
                @if($dailyBackupDB->approval_dba == 1)
                    {{ "Approve" }}
                @else
                    {{ Form::open(array('method'=>'POST', 'route'=>array('approveDBADailyBackupDB', $dailyBackupDB->id), 'class' => 'pull-left')) }}
                    {{ Form::submit('Approve', array('class' => 'btn btn-sm btn-warning')) }}
                    {{ Form::close() }}
                @endif
                @endif
            </td>


            <td>&nbsp;
                @if($currentUser->hasAccess('approveitdspv-dailyBackupDB'))
                @if($dailyBackupDB->approval_dba != 1)
                    {{ "Waiting for Approval DBA" }}
                @elseif($dailyBackupDB->approval_itd_dev == 1)
                    {{ "Approve" }}
                @else
                    {{ Form::open(array('method'=>'POST', 'route'=>array('approveITDSPVDailyBackupDB', $dailyBackupDB->id), 'class' => 'pull-left')) }}
                    {{ Form::submit('Approve', array('class' => 'btn btn-sm btn-warning')) }}
                    {{ Form::close() }}
                @endif
                @endif
            </td>

            <td>&nbsp;{{ $dailyBackupDB->getReceiverDate() }}</td>
            <td>&nbsp;
                @if($dailyBackupDB->status_activated == 1)
                    {{ "Yes" }}
                @else
                    {{ "No" }}
                @endif
            </td>
            <td class="visible-lg">
                <!-- Edit vendor -->
                <a class="fa fa-edit" href="{{ URL::route('showDailyBackupDB', $dailyBackupDB->getId()) }}" title="Edit"></a>
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