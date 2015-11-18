@extends(Config::get('adminlte::views.master'))

@section('content')

    <div class="row">
        <div class="col-lg-10">
            <div class="box box-primary">
                <div class="box-body clearfix">
                    {{ Form::model($monthlybackupDBs, array('route' => array('putMonthlyBackupDB', $monthlybackupDBs->id), 'method' => 'PUT')) }}
                    @if(Sentry::check())
                        <div class="row-fluid">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('id_master_DB', 'Database Master') }} <span class="error">{{ $errors->first('id_master_DB') }}</span>
                                    {{ Form::select('id_master_DB', array('default' => $monthlybackupDBs->masterDB->database_name) + $masterDBs, $monthlybackupDBs->id_master_DB, array('id' => 'id_master_DB', 'class' => 'col-lg-12 form-control',Input::old('id_master_DB')))  }}
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Period</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="span2 col-lg-6 form-control" value="{{ $monthlybackupDBs->period }}" id="dp3" data-date-format="yyyy-mm" name="dp3" placeholder="click here"/>
                                    </div><!-- /.input group -->
                                </div>
                                <div class="form-group">
                                {{ Form::hidden('user_backup', $monthlybackupDBs->user_backup, array('class' => 'col-lg-12 form-control')) }}
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Backup Date</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="span2 col-lg-6 form-control" value="{{ $monthlybackupDBs->backup_date }}" id="datetimepicker" data-date-format="yyyy-mm-dd hh:ii:ss" name="datepicker" placeholder="click here"/>
                                    </div><!-- /.input group -->
                                </div>
                                <div class="form-group">
                                    {{ Form::label('id_master_status', 'Backup Status') }} <span class="error">{{ $errors->first('id_master_status') }}</span>
                                    {{ Form::select('id_master_status', array('default' => $monthlybackupDBs->masterstatus->group.' - '.$monthlybackupDBs->masterstatus->status_name) + $masterstatuss, $monthlybackupDBs->id_master_status, array('id' => 'id_master_status', 'class' => 'col-lg-12 form-control',Input::old('id_master_status')))  }}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('remark', 'Remark') }} <span class="error">{{ $errors->first('remark') }}</span>
                                    {{ Form::textarea('remark', $monthlybackupDBs->remark, array('class' => 'col-lg-12 form-control')) }}
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