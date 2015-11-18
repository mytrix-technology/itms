@extends(Config::get('adminlte::views.master'))

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="box box-primary">
            <div class="box-body clearfix">
                {{ Notification::showAll() }}
                
                @if ($errors->any())
                    <div class="alert alert-error">
                        {{ implode('<br>', $errors->all()) }}
                    </div>
                @endif
                {{ Form::model($weeklymeetings, array('route' => array('putWeeklyMeeting', $weeklymeetings->id), 'method' => 'PUT', 'files' => true)) }}
                    @if(Sentry::check())
                    <div class="row-fluid">
                        <div class="col-lg-6">
                            <div class="form-group required">
                                {{ Form::label('weekly_meeting_subject', 'Subject', array('required' => 'required')) }} (* <span class="error">{{ $errors->first('weekly_meeting_subject') }}</span>
                                {{ Form::text('weekly_meeting_subject', $weeklymeetings->weekly_meeting_subject, array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                <label class="control-label">Date</label> (*
                                <p>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="span2 col-lg-6 form-control" value="{{ $weeklymeetings->weekly_meeting_date }}" id="datetimepicker" data-format="yyyy-mm-dd hh:ii:ss" name="weekly_meeting_date" placeholder="click here"/>
                                    </div><!-- /.input group -->
                                </p>
                            </div>
                            <div class="form-group">
                                    {{ Form::label('weekly_meeting_trainer', 'Trainer') }} (* <span class="error">{{ $errors->first('weekly_meeting_trainer') }}</span>
                                    {{ Form::select('weekly_meeting_trainer', array('default' => $weeklymeetings->user1->username) + $users, $weeklymeetings->weekly_meeting_trainer,  array('id' => 'weekly_meeting_trainer', 'class' => 'col-lg-12 form-control', Input::old('weekly_meeting_trainer')))  }}
                                </div>
                            <div class="form-group required">
                                {{ Form::label('weekly_meeting_user', 'Participants (Qty Person)', array('required' => 'required')) }} (* <span class="error">{{ $errors->first('weekly_meeting_user') }}</span>
                                {{ Form::text('weekly_meeting_user', $weeklymeetings->weekly_meeting_user, array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group required">
                                {{ Form::label('weekly_meeting_time', 'Times (Minutes)', array('required' => 'required')) }} (* <span class="error">{{ $errors->first('weekly_meeting_time') }}</span>
                                {{ Form::text('weekly_meeting_time', $weeklymeetings->weekly_meeting_time, array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <br><br>
                            <div class="form-group">
                                {{ Form::label('weekly_meeting_file', 'Upload File') }} 
                                {{ Form::file('fileWeeklyMeeting') }}
                                {{ Form::hidden('weekly_meeting_file', $weeklymeetings->weekly_meeting_file) }}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('weekly_meeting_note', 'Note') }} (* <span class="error">{{ $errors->first('weekly_meeting_note') }}</span>
                                {{ Form::textarea('weekly_meeting_note', $weeklymeetings->weekly_meeting_note, array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::hidden('user_updated', Sentry::getUser()->id, array('class' => 'col-lg-12 form-control')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
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