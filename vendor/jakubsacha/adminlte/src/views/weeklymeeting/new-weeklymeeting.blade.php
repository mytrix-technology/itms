@extends(Config::get('adminlte::views.master'))

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box box-primary">
            <div class="box-header">
                <h1 class="box-title">New Project Application</h1>
            </div>
            <div class="box-body">
                <?php if(Session::has('register_success')): ?>
                    <div class="message message-success">
                        <span class="close"></span>
                        <?php echo Session::get('register_success') ?>
                    </div>
                <?php endif; ?>
                {{ Form::open(array('url' => 'weeklymeeting/new', 'method' => 'post', 'files' => true)) }}
                    @if(Sentry::check())
                    <div class="row-fluid">
                        <div class="col-lg-6">
                            <div class="form-group required">
                                {{ Form::label('weekly_meeting_subject', 'Training Name', array('required' => 'required')) }} (* <span class="error">{{ $errors->first('weekly_meeting_subject') }}</span>
                                {{ Form::text('weekly_meeting_subject', Input::old('weekly_meeting_subject'), array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                <label class="control-label">Date</label> (*
                                <p>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="span2 col-lg-6 form-control" value id="datetimepicker" data-format="yyyy-mm-dd hh:ii:ss" name="weekly_meeting_date" placeholder="click here"/>
                                    </div><!-- /.input group -->
                                </p>
                            </div>
                            <div class="form-group">
                                {{ Form::label('weekly_meeting_trainer', 'Trainer') }} (* <span class="error">{{ $errors->first('weekly_meeting_trainer') }}</span>
                                {{ Form::select('weekly_meeting_trainer', $users, 'Choose User', array('id' => 'assignment_to', 'class' => 'col-lg-12 form-control'))  }}
                            </div>
                            <div class="form-group required">
                                {{ Form::label('weekly_meeting_user', 'Participants (Qty Person)', array('required' => 'required')) }} (* <span class="error">{{ $errors->first('weekly_meeting_user') }}</span>
                                {{ Form::text('weekly_meeting_user', Input::old('weekly_meeting_user'), array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group required">
                                {{ Form::label('weekly_meeting_time', 'Times (Minutes)', array('required' => 'required')) }} (* <span class="error">{{ $errors->first('weekly_meeting_time') }}</span>
                                {{ Form::text('weekly_meeting_time', Input::old('weekly_meeting_time'), array('class' => 'col-lg-12 form-control')) }}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('weekly_meeting_file', 'Upload File') }} 
                                {{ Form::file('fileWeeklyMeeting') }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('weekly_meeting_note', 'Note') }} (* <span class="error">{{ $errors->first('weekly_meeting_note') }}</span>
                                {{ Form::textarea('weekly_meeting_note', Input::old('weekly_meeting_note'), array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::hidden('user_created', Sentry::getUser()->id, array('class' => 'col-lg-12 form-control')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="pull-left">
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