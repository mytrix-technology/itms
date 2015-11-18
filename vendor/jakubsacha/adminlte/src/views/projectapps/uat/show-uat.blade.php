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
                {{ Form::model($uats, array('route' => array('putUat', $uats->id), 'method' => 'PUT', 'files' => true)) }}
                    @if(Sentry::check())
                    <div class="row-fluid">
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('sequence', 'Sequence') }} (* <span class="error">{{ $errors->first('sequence') }}</span>
                                {{ Form::text('sequence', $uats->sequence, array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('project_apps_id', 'Project Name') }} (* <span class="error">{{ $errors->first('project_apps_id') }}</span>
                                {{ Form::select('project_apps_id', array('default' => $uats->project->name_project) + $projects, $uats->project_apps_id, array('id' => 'project_apps_id', 'class' => 'col-lg-12 form-control', Input::old('project_apps_id')))  }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('user_request', 'User Accept Test Actual Date') }} (* <span class="error">{{ $errors->first('user_request') }}</span>
                                <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="span2 col-lg-6 form-control" value="{{ $uats->uat_actual_date }}" id="datetimepicker" data-date-format="yyyy-mm-dd hh:ii:ss" name="uat_actual_date" placeholder="click here"/>
                                    </div><!-- /.input group -->
                            </div>
                            <div class="form-group">
                                {{ Form::label('uat_target', 'User Accept Test Target') }} (* <span class="error">{{ $errors->first('uat_target') }}</span>
                                {{ Form::textarea('uat_target', $uats->uat_target, array('class' => 'col-lg-12 form-control')) }}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('uat_user', 'User Accept Test Person') }} (* <span class="error">{{ $errors->first('uat_user') }}</span>
                                {{ Form::select('uat_user', array('default' => $uats->user->username) + $users, $uats->uat_user, array('id' => 'uat_user', 'class' => 'col-lg-12 form-control',Input::old('uat_user')))  }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('uat_revision', 'Revision') }} (* <span class="error">{{ $errors->first('uat_revision') }}</span>
                                {{ Form::text('uat_revision', $uats->uat_revision, array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('uat_file', 'Upload File') }} 
                                {{ Form::file('fileUat') }}<span class="error">{{ $errors->first('fileUat') }}</span>
                            </div>
                            <div class="form-group">
                                {{ Form::label('uat_note', 'Note') }} (* <span class="error">{{ $errors->first('uat_note') }}</span>
                                {{ Form::textarea('uat_note', $uats->uat_note, array('class' => 'col-lg-12 form-control')) }}
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