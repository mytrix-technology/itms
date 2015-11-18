@extends(Config::get('adminlte::views.master'))

@section('content')
    <div class="row">
        <div class="col-lg-10">
            <div class="box box-primary">
                <div class="box-header">
                    <h1 class="box-title">New Database Monthly Report</h1>
                </div>
                <div class="box-body">
                    <?php if(Session::has('register_success')): ?>
                    <div class="message message-success">
                        <span class="close"></span>
                        <?php echo Session::get('register_success') ?>
                    </div>
                    <?php endif; ?>
                    {{ Form::open(array('url' => 'monthlyBackupDB/new')) }}
                    @if(Sentry::check())
                        <div class="row-fluid">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('id_master_DB', 'Database Master') }} <span class="error">{{ $errors->first('id_master_DB') }}</span>
                                    {{ Form::select('id_master_DB', $masterDBs, 'Choose Database', array('id' => 'id_master_DB', 'class' => 'col-lg-12 form-control'))  }}
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Period</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="span2 col-lg-6 form-control" value id="dp3" data-date-format="yyyy-mm" name="dp3" placeholder="click here"/>
                                    </div><!-- /.input group -->
                                </div>
                                <div class="form-group">
                                    {{ Form::hidden('user_backup', Sentry::getUser()->id.' - '.Sentry::getUser()->username, array('class' => 'col-lg-12 form-control')) }}
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Backup Date</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="span2 col-lg-6 form-control" value id="datetimepicker" data-format="yyyy-mm-dd hh:ii:ss" name="datepicker" placeholder="click here"/>
                                    </div><!-- /.input group -->
                                </div>
                                <div class="form-group">
                                    {{ Form::label('id_master_status', 'Backup Status') }} <span class="error">{{ $errors->first('id_master_status') }}</span>
                                    {{ Form::select('id_master_status', $masterstatuss, 'Choose Status', array('id' => 'id_master_status', 'class' => 'col-lg-12 form-control'))  }}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('remark', 'Remark') }} <span class="error">{{ $errors->first('remark') }}</span>
                                    {{ Form::textarea('remark', Input::old('remark'), array('class' => 'col-lg-12 form-control')) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::hidden('user_created', Sentry::getUser()->id, array('class' => 'col-lg-12 form-control')) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
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