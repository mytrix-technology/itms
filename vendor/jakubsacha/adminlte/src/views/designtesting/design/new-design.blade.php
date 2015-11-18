@extends(Config::get('adminlte::views.master'))

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box box-primary">
            <div class="box-header">
                <h1 class="box-title">New Design Application</h1>
            </div>
            <div class="box-body">
                <?php if(Session::has('register_success')): ?>
                    <div class="message message-success">
                        <span class="close"></span>
                        <?php echo Session::get('register_success') ?>
                    </div>
                <?php endif; ?>
                {{ Form::open(array('url' => 'design/new', 'method' => 'post', 'files' => true)) }}
                    @if(Sentry::check())
                    <div class="row-fluid">
                        <div class="col-lg-6">
                            <div class="form-group required">
                                {{ Form::label('project_apps_id', 'Project Name', array('required' => 'required')) }} (* <span class="error">{{ $errors->first('project_apps_id') }}</span>
                                {{ Form::select('project_apps_id', $projects, 'Choose Project', array('id' => 'project_apps_id', 'class' => 'col-lg-12 form-control', 'onchange' => 'javascript: addText();'))  }}
                            </div>
                            <br><br>
                            <div class="form-group">
                                {{ Form::label('design_table_file', 'Upload Design File') }} 
                                {{ Form::file('fileTable') }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('desc_table_file', 'Design Table and Form Description') }} 
                                {{ Form::textarea('desc_table_file', Input::old('desc_table_file'), array('class' => 'col-lg-12 form-control')) }}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('rule', 'Rule') }} (* <span class="error">{{ $errors->first('rule') }}</span>
                                {{ Form::textarea('rule', Input::old('rule'), array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('remark', 'Remark') }} (* <span class="error">{{ $errors->first('remark') }}</span>
                                {{ Form::textarea('remark', Input::old('remark'), array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::hidden('user_created', Sentry::getUser()->id, array('class' => 'col-lg-12 form-control')) }}
                                {{ Form::hidden('user_updated', Sentry::getUser()->id, array('class' => 'col-lg-12 form-control')) }}
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