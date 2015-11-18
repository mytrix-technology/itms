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
                {{ Form::model($assesments, array('route' => array('putAssesment', $assesments->id), 'method' => 'PUT', 'files' => true)) }}
                    @if(Sentry::check())
                    <div class="row-fluid">
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('name_project', 'Project Name') }} 
                                {{ Form::text('name_project', $assesments->name_project, array('class' => 'col-lg-12 form-control', 'disabled')) }}
                                {{ Form::hidden('project', $assesments->name_project, array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <br>
                            <div class="form-group">
                                {{ Form::label('reference', 'Reference Number') }} 
                                {{ Form::text('reference', $assesments->reference, array('class' => 'col-lg-12 form-control', 'disabled')) }}
                            </div>
                            <br><br>
                            <div class="form-group">
                                {{ Form::label('desc_project', 'Project Description') }} 
                                {{ Form::textarea('desc_project', $assesments->desc_project, array('class' => 'col-lg-12 form-control', 'disabled')) }}
                            </div>
                            <br /><br />
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Assesment Date (*</label> <span class="error">{{ $errors->first('assesment_date') }}</span>
                                <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="span2 col-lg-6 form-control" value = "{{ $assesments->assesment_date }}" id="datetimepicker2" data-format="yyyy-mm-dd hh:ii:ss" name="assesment_date" placeholder="click here"/>
                                    </div><!-- /.input group -->
                            </div>
                            <div class="form-group">
                                {{ Form::hidden('assesment_user', Sentry::getUser()->id.' - '.Sentry::getUser()->username, array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('fileAssesment', 'Upload File') }} 
                                {{ Form::file('fileAssesment') }}
                                {{ Form::hidden('assesment_file', $assesments->assesment_file) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('assesment_note', 'Note') }} (* <span class="error">{{ $errors->first('assesment_note') }}</span>
                                {{ Form::textarea('assesment_note', $assesments->assesment_note, array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::hidden('user_updated', Sentry::getUser()->id, array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <br /><br />
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="col-lg-12">
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

<!-- row -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- The time line -->
                            <ul class="timeline">
                                <!-- timeline time label -->
                                <li class="time-label">
                                    <span class="bg-aqua">
                                        History - {{ $assesments->name_project }}
                                    </span>
                                </li>
                                <!-- /.timeline-label -->
                                @foreach($assesments->historyassesment as $historyassesment)
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-tasks bg-maroon"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> {{ $historyassesment->created_at }}</span>
                                        <h3 class="timeline-header">
                                            <strong>{{ $historyassesment->user->username }}</strong> - {{ $historyassesment->title_history }}</h3>
                                        <div class="timeline-body">
                                            {{ $historyassesment->note_history}}
                                        </div>
                                        <div class='timeline-footer'>
                                            File : <a href="{{ URL::route('downloadAssesmentFiles', $timelineAssesments->id) }}">{{ $historyassesment->file_history}}</a>
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