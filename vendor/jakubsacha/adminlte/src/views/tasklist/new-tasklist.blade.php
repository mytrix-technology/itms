@extends(Config::get('adminlte::views.master'))

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box box-primary">
            <div class="box-header">
                <h1 class="box-title">New Tasklist</h1>
            </div>
            <div class="box-body">
                {{ Form::open(array('url' => 'task/new', 'method' => 'post', 'files' => true)) }}
                    @if(Sentry::check())
                    <div class="row-fluid">
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('subject', 'Subject') }} (* <span class="error">{{ $errors->first('subject') }}</span>
                                {{ Form::text('subject', Input::old('subject'), array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::hidden('assignment_from', Sentry::getUser()->id, array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('assignment_to', 'Assignment To') }} (* <span class="error">{{ $errors->first('assignment_to') }}</span>
                                {{ Form::select('assignment_to', $users, 'Choose User', array('id' => 'assignment_to', 'class' => 'col-lg-12 form-control'))  }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('assignment_cc', 'Assignment CC') }} (* <span class="error">{{ $errors->first('assignment_cc') }}</span>
                                {{ Form::select('assignment_cc', $users, 'Choose User', array('id' => 'assignment_cc', 'class' => 'col-lg-12 form-control', 'multiple'))  }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('mytextarea', 'Tasklist Description') }} (* <span class="error">{{ $errors->first('mytextarea') }}</span>
                                {{ Form::textarea('mytextarea', Input::old('mytextarea'), array('id' => 'mytextarea','class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                <label class="control-label">Due Date</label> (*
                                <p>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="span2 col-lg-6 form-control" value id="datetimepicker" data-date-format="yyyy-mm-dd hh:ii:ss" name="datepicker1" placeholder="click here"/>
                                    </div><!-- /.input group -->
                                </p>
                            </div>
                            <div class="form-group required">
                                {{ Form::label('reference', 'Reference Project') }} 
                                {{ Form::select('reference', $projects, 'Choose Project', array('id' => 'reference', 'class' => 'col-lg-12 form-control'))  }}
                            </div>
                            <div class="form-group required">
                                {{ Form::label('reference_design', 'Reference Design Name Version') }} 
                                {{ Form::select('reference_design', array(), null, array('id' => 'reference_design', 'class' => 'col-lg-12 form-control'))  }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('parameter_reminder', 'Parameter Reminder') }} (* <span class="error">{{ $errors->first('parameter_reminder') }}</span>
                                {{ Form::text('parameter_reminder', Input::old('parameter_reminder'), array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            
                            <div class="form-group required">
                                {{ Form::label('priority', 'Priority') }} (* <span class="error">{{ $errors->first('priority') }}</span>
                                {{ Form::select('priority', $prioritys, 'Choose Priority', array('id' => 'priority', 'class' => 'col-lg-12 form-control'))  }}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('fileTask', 'Upload File') }}
                                {{ Form::file('fileTask') }}
                            </div>
                            <div class="form-group required">
                                {{ Form::label('master_task_type_id', 'Task Type Master') }} (* <span class="error">{{ $errors->first('master_task_type_id') }}</span>
                                {{ Form::select('master_task_type_id', $mastertasktypes, 'Choose Task Type Master', array('id' => 'master_task_type_id', 'class' => 'col-lg-12 form-control'))  }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('database_change', 'Change Plan in Database') }} 
                                {{ Form::textarea('database_change', Input::old('database_change'), array('id' => 'database_change', 'class' => 'col-lg-12 form-control', 'placeholder' => 'Input Change Plan in database', 'style' => 'display:none')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('apps_file_change', 'Change Plan in Application File') }} 
                                {{ Form::textarea('apps_file_change', Input::old('apps_file_change'), array('id' => 'apps_file_change', 'class' => 'col-lg-12 form-control', 'placeholder' => 'Input Change Plan in Application File', 'style' => 'display:none')) }}
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
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('#reference').on('change', function(){
                            $.post('{{ URL::to('task/new') }}', {type: 'reference_design', id: $('#reference').val()}, function(e){
                                $('#reference_design').html(e);
                            });
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>
@stop