@extends(Config::get('adminlte::views.master'))

@section('content')

    <div class="row">
        <div class="col-lg-10">
            <div class="box box-primary">
                <div class="box-body clearfix">
                    {{ Form::model($dailybackupDBs, array('route' => array('putDailyBackupDB', $dailybackupDBs->id), 'method' => 'PUT')) }}
                    @if(Sentry::check())
                        <div class="row-fluid">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('id_master_DB', 'Database Master') }} <span class="error">{{ $errors->first('id_master_DB') }}</span>
                                    {{ Form::select('id_master_DB', array('default' => $dailybackupDBs->masterDB->database_name) + $masterDBs, $dailybackupDBs->id_master_DB, array('id' => 'id_master_DB', 'class' => 'col-lg-12 form-control',Input::old('id_master_DB')))  }}
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Period</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="span2 col-lg-6 form-control" value="{{ $dailybackupDBs->period }}" id="dp3" data-date-format="yyyy-mm" name="dp3" placeholder="click here"/>
                                    </div><!-- /.input group -->
                                </div>
                                <div class="form-group">
                                    {{ Form::hidden('user_backup', $dailybackupDBs->user_backup, array('class' => 'col-lg-12 form-control')) }}
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Backup Date</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="span2 col-lg-6 form-control" value="{{ $dailybackupDBs->backup_date }}" id="datetimepicker" data-format="yyyy-mm-dd hh:ii:ss" name="datepicker" placeholder="click here"/>
                                    </div><!-- /.input group -->
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Receiver Database Physic Date</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="span2 col-lg-6 form-control" value="{{ $dailybackupDBs->receiver_date }}" id="datetimepicker2" data-date-format="yyyy-mm-dd hh:ii:ss" name="datepicker2" placeholder="click here"/>
                                    </div><!-- /.input group -->
                                </div>
                                <div class="form-group">
                                    {{ Form::label('status_activated', 'Status : ') }}
                                    {{ Form::radio('status_activated', 1) }}&nbsp;&nbsp;{{ Form::label('active', 'Active') }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    {{ Form::radio('status_activated', 0) }}&nbsp;&nbsp;{{ Form::label('noActive', 'No Active') }}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('id_master_status', 'Backup Status') }} <span class="error">{{ $errors->first('id_master_status') }}</span>
                                    {{ Form::select('id_master_status', array('default' => $dailybackupDBs->masterstatus->group.' - '.$dailybackupDBs->masterstatus->status_name) + $masterstatuss, $dailybackupDBs->id_master_status, array('id' => 'id_master_status', 'class' => 'col-lg-12 form-control',Input::old('id_master_status')))  }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('remark', 'Remark') }} <span class="error">{{ $errors->first('remark') }}</span>
                                    {{ Form::textarea('remark', $dailybackupDBs->remark, array('class' => 'col-lg-12 form-control')) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::hidden('user_updated', Sentry::getUser()->id, array('class' => 'col-lg-12 form-control')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="col-lg-12">
                                <div class="pull-right">
                                    {{ Form::submit('Submit', array('class' => 'btn btn-primary', 'style' => 'margin-top: 15px;')) }}
                                </div>
                            </div>
                        </div>
                    @endif
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@stop