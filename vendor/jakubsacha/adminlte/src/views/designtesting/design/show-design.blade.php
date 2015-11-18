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
                {{ Form::model($designs, array('route' => array('putDesign', $designs->id), 'method' => 'PUT', 'files' => true)) }}
                    @if(Sentry::check())
                    <div class="row-fluid">
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('project_apps_id', 'Project Name') }} (* <span class="error">{{ $errors->first('project_apps_id') }}</span>
                                {{ Form::select('project_apps_id', array('default' => $designs->project->name_project) + $projects, $designs->project_id, array('id' => 'project_apps_id', 'class' => 'col-lg-12 form-control', Input::old('project_apps_id')))  }}
                                {{ Form::hidden('design_name_version', $designs->design_name_version, array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <br><br>
                            <div class="form-group">
                                {{ Form::label('design_table_file', 'Upload Design File') }} 
                                {{ Form::file('fileTable') }}
                                {{ Form::hidden('design_table_file', $designs->design_table_file) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('desc_table_file', 'Design Table and Form Description') }} 
                                {{ Form::textarea('desc_table_file', $designs->desc_table_file, array('class' => 'col-lg-12 form-control')) }}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('rule', 'Rule') }} (* <span class="error">{{ $errors->first('rule') }}</span>
                                {{ Form::textarea('rule', $designs->rule, array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('remark', 'Remark') }} (* <span class="error">{{ $errors->first('remark') }}</span>
                                {{ Form::textarea('remark', $designs->remark, array('class' => 'col-lg-12 form-control')) }}
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