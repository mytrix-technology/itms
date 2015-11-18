@extends(Config::get('adminlte::views.master'))

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box box-primary">
            <div class="box-header">
                <h1 class="box-title">New Project Application</h1>
            </div>
            <div class="box-body">
                {{ Form::open(array('url' => 'updateapps/new')) }}
                    @if(Sentry::check())
                    <div class="row-fluid">
                        <div class="col-lg-6">
                        	<div class="form-group">
                                {{ Form::label('id_project', 'Application Project') }} (* <span class="error">{{ $errors->first('id_project') }}</span>
                                {{ Form::select('id_project', $projectNames, 'default', array('class' => 'col-lg-12 form-control'))  }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('user_request', 'User Request') }} 
                                {{ Form::text('user_request', Input::old('user_request'), array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                <label class="control-label">Request Date</label>
                                <p>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="span2 col-lg-6 form-control" value id="datetimepicker" data-format="yyyy-mm-dd hh:ii:ss" name="request_date" placeholder="click here"/>
                                    </div><!-- /.input group -->
                                </p>
                            </div>
                            <div class="form-group">
                                {{ Form::label('database_change', 'Change in Database') }} (* <span class="error">{{ $errors->first('database_change') }}</span>
                                {{ Form::textarea('database_change', Input::old('database_change'), array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('apps_change', 'Change in Application') }} (* <span class="error">{{ $errors->first('apps_change') }}</span>
                                {{ Form::textarea('apps_change', Input::old('apps_change'), array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <br>
                            <div class="form-group">
                                {{ Form::label('manual_book_file', 'Upload Manual Book') }} 
                                {{ Form::file('fileManual') }}<span class="error">{{ $errors->first('fileManual') }}</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            
                            <div class="form-group">
                                {{ Form::label('apps_version', 'Application Version') }} (* <span class="error">{{ $errors->first('apps_version') }}</span>
                                {{ Form::text('apps_version', Input::old('apps_version'), array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                <label class="control-label">Update Date</label>
                                <p>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="span2 col-lg-6 form-control" value id="datetimepicker1" data-format="yyyy-mm-dd hh:ii:ss" name="update_date" placeholder="click here"/>
                                    </div><!-- /.input group -->
                                </p>
                            </div>
                            <div class="form-group">
                                {{ Form::label('pic', 'PIC') }} (* <span class="error">{{ $errors->first('pic') }}</span>
                                {{ Form::select('pic', $users, 'default', array('class' => 'col-lg-12 form-control'))  }}
                            </div>
                            <div class="form-group required">
                                {{ Form::label('filename_update', 'Filename Update') }} (* <span class="error">{{ $errors->first('filename_update') }}</span>
                                {{ Form::textarea('filename_update', Input::old('filename_update'), array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('remark', 'Remark') }} (*
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