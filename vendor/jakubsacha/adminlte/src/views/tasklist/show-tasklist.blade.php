@extends(Config::get('adminlte::views.master'))

@section('content')
    
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-body clearfix">
                    {{ Form::model($tasks, array('route' => array('putTask', $tasks->id), 'method' => 'PUT', 'files' => true)) }}
                    @if(Sentry::check())
                    <?php
                        $userlogin;
                        $adm = Sentry::findGroupByName('Admin');
                        $head = Sentry::findGroupByName('HeadITDev');
                        $coord = Sentry::findGroupByName('CoordinatorITDev');
                    ?>
                        <div class="row-fluid">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('subject', 'Subject') }} (* <span class="error">{{ $errors->first('subject') }}</span>
                                    {{ Form::text('subject', $tasks->subject, array('class' => 'col-lg-12 form-control')) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('assignment_from', 'Assignment From') }} (* <span class="error">{{ $errors->first('assignment_from') }}</span>
                                    {{ Form::select('assignment_from', array('default' => Sentry::getUser()->username) + $users, Sentry::getUser()->id,  array('id' => 'assignment_from', 'class' => 'col-lg-12 form-control', Input::old('assignment_from')))  }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('assignment_to', 'Assignment To') }} (* <span class="error">{{ $errors->first('assignment_to') }}</span>
                                    {{ Form::select('assignment_to', array('default' => $tasks->user2->username) + $users, $tasks->assignment_to,  array('id' => 'assignment_to', 'class' => 'col-lg-12 form-control', Input::old('assignment_to')))  }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('assignment_cc', 'Assignment CC') }} (* <span class="error">{{ $errors->first('assignment_cc') }}</span>
                                    {{ Form::select('assignment_cc', $users, 'Choose User', array('id' => 'assignment_cc', 'class' => 'col-lg-12 form-control', 'multiple'))  }}
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Assignment Date</label> (*
                                    <p>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="span2 col-lg-6 form-control" value="{{ $tasks->assignment_date }}" id="datetimepicker" data-date-format="yyyy-mm-dd hh:ii:ss" name="datepicker" placeholder="click here"/>
                                    </div><!-- /.input group -->
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Due Date</label> (*
                                    <p>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="span2 col-lg-6 form-control" value="{{ $tasks->due_date }}" id="datetimepicker1" data-date-format="yyyy-mm-dd hh:ii:ss" name="datepicker1" placeholder="click here"/>
                                    </div><!-- /.input group -->
                                    </p>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('mytextarea', 'Tasklist Description') }} (* <span class="error">{{ $errors->first('mytextarea') }}</span>
                                    {{ Form::textarea('mytextarea', $tasks->desc_tasklist, array('id' => 'mytextarea','class' => 'col-lg-12 form-control')) }}
                                </div>
                                <div class="form-group required">
                                    {{ Form::label('reference', 'Reference') }}
                                    @if($tasks->reference == null)
                                        {{ Form::select('reference', $projects, 'Choose Project', array('id' => 'reference', 'class' => 'col-lg-12 form-control'))  }}
                                    @else
                                        {{ Form::select('reference', array('default' => $tasks->project->name_project) + $projects, $tasks->reference, array('id' => 'reference', 'class' => 'col-lg-12 form-control', Input::old('reference')))  }}
                                    @endif
                                </div>
                                <div class="form-group required">
                                    {{ Form::label('reference', 'Reference Design') }}
                                    @if($tasks->reference_design == null)
                                        {{ Form::select('reference_design', array(), null, array('id' => 'reference_design', 'class' => 'col-lg-12 form-control'))  }}
                                    @else
                                        {{ Form::select('reference_design', array('default' => $tasks->design->design_name_version) + $designs, $tasks->reference_design, array('id' => 'reference_design', 'class' => 'col-lg-12 form-control', Input::old('reference')))  }}
                                    @endif
                                </div>
                                <div class="form-group">
                                    {{ Form::label('parameter_reminder', 'Parameter Reminder') }} (* <span class="error">{{ $errors->first('parameter_reminder') }}</span>
                                    {{ Form::text('parameter_reminder', $tasks->parameter_reminder, array('class' => 'col-lg-12 form-control')) }}
                                </div>
                                <div class="form-group required">
                                    {{ Form::label('priority', 'Priority', array('required' => 'required')) }} (* <span class="error">{{ $errors->first('priority') }}</span>*
                                    {{ Form::select('priority', array('default' => $tasks->masterstatus1->status_name) + $masterstatuss1, $tasks->priority, array('id' => 'priority', 'class' => 'col-lg-12 form-control', Input::old('priority'))) }}
                                </div>
                                <br /><br />
                                <div class="form-group">
                                    <input type="checkbox" name="comment" id="comment" value="comment" /> -- New Comment
                                </div>
                                <div class="form-group">
                                    {{ Form::label('title_history', 'Title Comment') }}
                                    {{ Form::text('title_history', Input::old('title_history'), array('id' => 'title_history', 'class' => 'col-lg-12 form-control', 'placeholder' => 'Input Title Comment', 'style' => 'display:none')) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('note_history', 'Comment') }}
                                    {{ Form::textarea('note_history', Input::old('note_history'), array('id' => 'note_history', 'class' => 'col-lg-12 form-control', 'placeholder' => 'Input Comment', 'style' => 'display:none')) }}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                @if($tasks->assignment_from == Sentry::getUser()->id || Sentry::getUser()->inGroup($adm) || Sentry::getUser()->inGroup($head) || Sentry::getUser()->inGroup($coord))
                                <div class="form-group required">
                                    {{ Form::label('status_tasklist', 'Tasklist Status', array('required' => 'required')) }} <span class="error">{{ $errors->first('status_tasklist') }}</span>
                                    {{ Form::select('status_tasklist', array('default' => $tasks->masterstatus->status_name) + $masterstatuss, $tasks->status_tasklist, array('id' => 'status_tasklist', 'class' => 'col-lg-12 form-control', Input::old('status_tasklist')))  }}
                                </div>
                                @else
                                <div class="form-group required">
                                    {{ Form::label('status_tasklist', 'Tasklist Status :', array('required' => 'required')) }} &nbsp;&nbsp;
                                    {{ Form::radio('status_tasklist', 6) }}&nbsp;&nbsp;{{ Form::label('progress', 'In Progress') }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    {{ Form::radio('status_tasklist', 7) }}&nbsp;&nbsp;{{ Form::label('test', 'Test Request') }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </div>
                                @endif
                                <div class="form-group">
                                    {{ Form::label('fileTask', 'Upload File') }}
                                    {{ Form::file('fileTask') }}
                                    {{ Form::hidden('upload_file', $tasks->upload_file) }}
                                </div>
                                <div class="form-group required">
                                    {{ Form::label('master_task_type_id', 'Task Type Master', array('required' => 'required')) }} (* <span class="error">{{ $errors->first('master_task_type_id') }}</span>
                                    {{ Form::select('master_task_type_id', array('default' => $tasks->mastertasktype->name_task_type) + $mastertasktypes, $tasks->master_task_type_id, array('id' => 'master_task_type_id', 'class' => 'col-lg-12 form-control', Input::old('master_task_type_id')))  }}
                                </div>
                                <br>
                                <div class="form-group">
                                    {{ Form::label('database_change', 'Change Plan in Database') }} 
                                    {{ Form::textarea('database_change', Input::old('database_change'), array('id' => 'database_change', 'class' => 'col-lg-12 form-control', 'placeholder' => 'Input Change Plan in database', 'style' => 'display:none')) }}
                                </div>
                                <br>
                                <div class="form-group">
                                    {{ Form::label('apps_file_change', 'Change Plan in Application File') }} 
                                    {{ Form::textarea('apps_file_change', Input::old('apps_file_change'), array('id' => 'apps_file_change', 'class' => 'col-lg-12 form-control', 'placeholder' => 'Input Change Plan in Application File', 'style' => 'display:none')) }}
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

    <!-- row -->
    <div class="row">
        <div class="col-md-12">
            <!-- The time line -->
            <ul class="timeline">
                <!-- timeline time label -->
                <li class="time-label">
                    <span class="bg-aqua">
                        History - {{ $tasks->subject }}
                    </span>
                </li>
                <!-- /.timeline-label -->
                @foreach($tasks->historytasklist as $historytasklist)
                <!-- timeline item -->
                    <li>
                        <i class="fa fa-tasks bg-maroon"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> {{ $historytasklist->created_at }}</span>
                            <h3 class="timeline-header"><strong>{{ $historytasklist->user1->username }}</strong> - {{ $historytasklist->title_history }}</h3>
                            <div class="timeline-body">
                                {{ $historytasklist->note_history }}
                            </div>
                            <div class='timeline-footer'>
                                        
                            </div>
                        </div>
                    </li>
                @endforeach
                <!-- END timeline item -->
                <li>
                    <i class="fa fa-clock-o"></i>
                </li>
            </ul>
        </div><!-- /.col -->
    </div><!-- /.row -->
@stop