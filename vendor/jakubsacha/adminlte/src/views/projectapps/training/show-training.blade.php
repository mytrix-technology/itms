@extends(Config::get('adminlte::views.master'))

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="box box-primary">
            <div class="box-body clearfix">
                {{ Form::model($trainings, array('route' => array('putTraining', $trainings->id), 'method' => 'PUT', 'files' => true)) }}
                    @if(Sentry::check())
                    <div class="row-fluid">
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('name_project', 'Project Name') }} 
                                {{ Form::text('name_project', $trainings->name_project, array('class' => 'col-lg-12 form-control', 'disabled')) }}
                                {{ Form::hidden('project', $trainings->name_project, array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                <label class="control-label">Training Actual Date</label> (*
                                <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="span2 col-lg-6 form-control" value="{{ $trainings->training_actual_date}}" id="datetimepicker" data-format="yyyy-mm-dd hh:ii:ss" name="training_actual_date" placeholder="click here"/>
                                    </div><!-- /.input group -->
                            </div>
                            <div class="form-group">
                                {{ Form::label('trainer', 'Trainer') }} (* <span class="error">{{ $errors->first('trainer') }}</span>
                                @if($trainings->trainer != null)
                                    {{ Form::select('trainer', array('default' => $trainings->user->username) + $users, $trainings->trainer, array('id' => 'trainer', 'class' => 'col-lg-12 form-control'))  }}
                                @else
                                    {{ Form::select('trainer', array('default' => 'Choose Trainer') + $users, 'default', array('id' => 'trainer', 'class' => 'col-lg-12 form-control'))  }}
                                @endif
                            </div>
                            <div class="form-group">
                                {{ Form::label('training_file', 'Upload File') }} 
                                {{ Form::file('fileTraining') }}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('training_target', 'Training Target') }} (* <span class="error">{{ $errors->first('training_target') }}</span>
                                {{ Form::textarea('training_target', $trainings->training_target, array('class' => 'col-lg-12 form-control')) }}
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