@extends(Config::get('adminlte::views.master'))

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box box-primary">
            <div class="box-header">
                <h1 class="box-title">New User Accept Test</h1>
            </div>
            <div class="box-body">
                <?php if(Session::has('register_success')): ?>
                    <div class="message message-success">
                        <span class="close"></span>
                        <?php echo Session::get('register_success') ?>
                    </div>
                <?php endif; ?>
                {{ Form::open(array('url' => 'uat/new', 'method' => 'post', 'files' => true)) }}
                    @if(Sentry::check())
                    <div class="row-fluid">
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('project_apps_id', 'Project Name') }} (* <span class="error">{{ $errors->first('project_apps_id') }}</span>
                                {{ Form::select('project_apps_id', $projects, 'Choose Project', array('id' => 'sProject', 'class' => 'col-lg-12 form-control'))  }}
                            </div>
							<div class="form-group required">
                                {{ Form::label('sequence', 'Sequence', array('required' => 'required')) }} (* <span class="error">{{ $errors->first('sequence') }}</span>
                                {{ Form::text('sequence', null, array('id' => 'sSequence','class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                <label class="control-label">User Accept Test Actual Date</label> (*
                                <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="span2 col-lg-6 form-control" value id="datetimepicker" data-date-format="yyyy-mm-dd hh:ii:ss" name="uat_actual_date" placeholder="click here"/>
                                    </div><!-- /.input group -->
                            </div>
							<div class="form-group">
                                {{ Form::label('uat_target', 'User Accept Test Target') }} (* <span class="error">{{ $errors->first('uat_target') }}</span>
                                {{ Form::textarea('uat_target', Input::old('uat_target'), array('class' => 'col-lg-12 form-control')) }}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('uat_user', 'User Accept Test Person') }} (* <span class="error">{{ $errors->first('uat_user') }}</span>
                                {{ Form::select('uat_user', $users, 'Choose Person', array('id' => 'uat_user', 'class' => 'col-lg-12 form-control'))  }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('uat_revision', 'Revision') }} (* <span class="error">{{ $errors->first('uat_revision') }}</span>
                                {{ Form::text('uat_revision', Input::old('uat_revision'), array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('uat_file', 'Upload File') }} 
                                {{ Form::file('fileUat') }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('uat_note', 'Note') }} (* <span class="error">{{ $errors->first('uat_note') }}</span>
                                {{ Form::textarea('uat_note', Input::old('uat_note'), array('class' => 'col-lg-12 form-control')) }}
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