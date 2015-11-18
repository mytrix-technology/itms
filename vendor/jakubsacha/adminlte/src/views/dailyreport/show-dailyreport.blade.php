@extends(Config::get('adminlte::views.master'))

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-body clearfix">
                    {{ Form::model($dailyreports, array('route' => array('putDailyReport', $dailyreports->id), 'method' => 'PUT', 'id' => 'updateDailyReport')) }}
                    @if(Sentry::check())
                        <div class="row-fluid">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('subject', 'Tasklist Subject') }} <span class="error">{{ $errors->first('subject') }}</span>
                                    {{ Form::text('desc_tasklist', $dailyreports->tasklist->subject, array('class' => 'col-lg-12 form-control', 'disabled')) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('assignment_from', 'Reference') }} <span class="error">{{ $errors->first('assignment_from') }}</span>
                                    {{ Form::text('desc_tasklist', $dailyreports->project->name_project, array('class' => 'col-lg-12 form-control', 'disabled')) }}
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Create Date</label>
                                    <p>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="span2 col-lg-6 form-control" value="{{ $dailyreports->create_date }}" id="datepicker" data-date-format="yyyy-mm-dd" name="datepicker" placeholder="click here" disabled/>
                                    </div><!-- /.input group -->
                                    </p>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('assignment_to', 'Job') }} <span class="error">{{ $errors->first('assignment_to') }}</span>
                                    {{ Form::text('desc_tasklist', $dailyreports->job, array('class' => 'col-lg-12 form-control', 'disabled')) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('desc_tasklist', 'Description') }} <span class="error">{{ $errors->first('desc_tasklist') }}</span>
                                    {{ Form::textarea('desc_tasklist', $dailyreports->description, array('class' => 'col-lg-12 form-control', 'disabled')) }}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Target Finish</label>
                                    <p>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="span2 col-lg-6 form-control" value="{{ $dailyreports->target_finish }}" id="datepicker1" data-date-format="yyyy-mm-dd" name="datepicker1" placeholder="click here" disabled/>
                                    </div><!-- /.input group -->
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Actual Finish Date</label>
                                    <p>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="span2 col-lg-6 form-control" value="{{ $dailyreports->actual_finish_date }}" id="datepicker2" data-date-format="yyyy-mm-dd" name="datepicker2" placeholder="click here"/>
                                    </div><!-- /.input group -->
                                    </p>
                                </div>
                                <div class="form-group required">
                                    {{ Form::label('note', 'Note', array('required' => 'required')) }} <span class="error">{{ $errors->first('note') }}</span>
                                    {{ Form::textarea('note', $dailyreports->note, array('class' => 'col-lg-12 form-control')) }}
                                </div>
                                <div class="form-group required">
                                    {{ Form::label('status_job_daily_report', 'Status :') }} 
                                    {{ Form::radio('status_job_daily_report', 9) }}&nbsp;&nbsp;{{ Form::label('close', 'Close') }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    {{ Form::radio('status_job_daily_report', 8) }}&nbsp;&nbsp;{{ Form::label('revision', 'Revision') }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    {{ Form::radio('status_job_daily_report', 7) }}&nbsp;&nbsp;{{ Form::label('test', 'Test Request') }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    {{ Form::radio('status_job_daily_report', 6) }}&nbsp;&nbsp;{{ Form::label('progress', 'In Progress') }}
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