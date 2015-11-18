@extends(Config::get('adminlte::views.master'))

@section('content')
    <script src="{{ asset('packages/mrjuliuss/syntara/assets/js/dashboard/user.js') }}"></script>

    @include('syntara::layouts.dashboard.confirmation-modal', array('title' => trans('syntara::all.confirm-delete-title'), 'content' => trans('syntara::all.confirm-delete-message'), 'type' => 'delete-user'))

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-warning collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">Search</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div><!-- /.box-tools -->
                </div>
                <div class="box-body">
                    {{ Form::open(array('url' => 'monthlyBackupDBs')) }}
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('databaseMasterSearch', 'Database Master') }}
                                {{ Form::select('databaseMasterSearch', $masterDBs, 'Choose Database Master', array('id' => 'databaseMasterSearch', 'class' => 'col-lg-12 form-control'))  }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('userBackupSearch', 'User Backup') }}
                                {{ Form::select('userBackupSearch', $users, 'Choose User', array('id' => 'userBackupSearch', 'class' => 'col-lg-12 form-control'))  }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('backupStatusSearch', 'Backup Status') }}
                                {{ Form::select('backupStatusSearch', $masterstatuss, 'Choose Status', array('id' => 'backupStatusSearch', 'class' => 'col-lg-12 form-control'))  }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('activatedSearch', 'Activated') }}
                                {{ Form::select('activatedSearch', array('1' => 'Active', '0' => 'Non Active'),'0', array('id' => 'activatedSearch', 'class' => 'col-lg-12 form-control')) }}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('periodSearch', 'Period') }}
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="span2 col-lg-6 form-control" value id="dp3" data-date-format="yyyy-mm" name="period" placeholder="click here"/>
                                </div><!-- /.input group -->
                            </div>
                            <div class="form-group">
                                {{ Form::label('backupDateSearch', 'Backup Date') }}
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="span2 col-lg-6 form-control" value id="datetimepicker" data-format="yyyy-mm-dd hh:ii:ss" name="backupDate" placeholder="click here"/>
                                </div><!-- /.input group -->
                            </div>
                            <div class="form-group">
                                {{ Form::label('receiverDateSearch', 'Receiver Date') }}
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="span2 col-lg-6 form-control" value id="datetimepicker2" data-format="yyyy-mm-dd hh:ii:ss" name="receiverDate" placeholder="click here"/>
                                </div><!-- /.input group -->
                            </div>
                        </div>
                        {{ Form::submit('Search', array('class' => 'btn btn-primary', 'style' => 'margin-top: 15px;')) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List of Database Monthly Backup</h3>
                    <p class="pull-right">
                            @if($currentUser->hasAccess('create-monthlyBackupDB'))
                                <a class="btn btn-app" href="{{ URL::route('newMonthlyBackupDB') }}">
                                    <i class="fa fa-plus"></i> New
                                </a>
                            @endif
                        </p>
                    
                </div>
                <div class="box-body  ajax-content no-padding">
                    @include('adminlte::backupdatabase.monthly.list-monthlybackupdatabase')
                </div>
            </div>
        </div>
    </div>


@stop