@extends(Config::get('adminlte::views.master'))

@section('content')

<div class="row">
    <div class="col-lg-8">
        <div class="box box-primary">
            <div class="box-body clearfix">
                {{ Notification::showAll() }}
                
                @if ($errors->any())
                    <div class="alert alert-error">
                        {{ implode('<br>', $errors->all()) }}
                    </div>
                @endif
                {{ Form::model($testings, array('route' => array('putTesting', $testings->id), 'method' => 'PUT')) }}
                    @if(Sentry::check())
                    <div class="row-fluid">
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('requirement_testing', 'Requirement Testing') }} (* <span class="error">{{ $errors->first('requirement_testing') }}</span>
                                {{ Form::textarea('requirement_testing', $testings->requirement_testing, array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('sit', 'SIT') }} (* <span class="error">{{ $errors->first('desc_project') }}</span>
                                {{ Form::textarea('sit', $testings->sit, array('class' => 'col-lg-12 form-control')) }}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('name_project', 'Project Name') }} (* <span class="error">{{ $errors->first('name_project') }}</span>
                                {{ Form::text('name_project', $testings->project->name_project, array('class' => 'col-lg-12 form-control', 'disabled')) }}
                            </div>
                            <div class="form-group">
                                <label class="control-label">SIT Date</label> (*
                                <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="span2 col-lg-6 form-control" value="{{ $testings->sit_date }}" id="datetimepicker" data-date-format="yyyy-mm-dd hh:ii:ss" name="sit_date" placeholder="click here"/>
                                    </div><!-- /.input group -->
                            </div>
                            <div class="form-group">
                                {{ Form::label('status_sit', 'SIT Status : ') }} (*
                                {{ Form::radio('status_sit', 13) }}&nbsp;&nbsp;{{ Form::label('Open', 'Open') }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                {{ Form::radio('status_sit', 14) }}&nbsp;&nbsp;{{ Form::label('pending', 'Pending') }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                {{ Form::radio('status_sit', 15) }}&nbsp;&nbsp;{{ Form::label('close', 'Close') }}
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