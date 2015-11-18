@extends(Config::get('adminlte::views.master'))

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box box-primary">
            <div class="box-header">
                <h1 class="box-title">New Project Application</h1>
            </div>
            <div class="box-body">
                {{ Form::open(array('url' => 'project/new', 'method' => 'post', 'files' => true)) }}
                    @if(Sentry::check())
                    <div class="row-fluid">
                        <div class="col-lg-6">
                            <div class="form-group required">
                                {{ Form::label('name_project', 'Project Name', array('required' => 'required')) }} (* <span class="error">{{ $errors->first('name_project') }}</span>
                                {{ Form::text('name_project', Input::old('name_project'), array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            
                            <div class="form-group">
                                {{ Form::label('desc_project', 'Project Description') }} (* <span class="error">{{ $errors->first('desc_project') }}</span>
                                {{ Form::textarea('desc_project', Input::old('desc_project'), array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                <label class="control-label">Due Date</label> (*
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="span2 col-lg-6 form-control" value id="datetimepicker" data-format="yyyy-mm-dd hh:ii:ss" name="datepicker" placeholder="click here"/>
                                </div><!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('master_type_project_id', 'Project Type Master') }} (* <span class="error">{{ $errors->first('master_type_project_id') }}</span>
                                {{ Form::select('master_type_project_id', $masterprojecttypes, 'Choose Project Type Master', array('id' => 'master_type_project_id', 'class' => 'col-lg-12 form-control'))  }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('reference', 'Reference Number') }} 
                                {{ Form::text('reference', Input::old('reference'), array('id' => 'reference','class' => 'col-lg-12 form-control', 'placeholder' => 'Input Reference Number', 'style' => 'display:none')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('user_request', 'User Request') }} (* <span class="error">{{ $errors->first('user_request') }}</span>
                                {{ Form::text('user_request', Input::old('user_request'), array('class' => 'col-lg-12 form-control')) }}
                            </div>
                        	<div class="form-group">
                                {{ Form::label('master_apps_id', 'Application Master') }} 
                                {{ Form::select('apps', $masterappss, 'Choose Application Master', array('id' => 'sApps', 'class' => 'col-lg-12 form-control'))  }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('master_modul_id', 'Modul Master') }} 
                                {{ Form::select('modul', array(), null, array('id' => 'sModul', 'class' => 'col-lg-12 form-control'))  }}
                            </div>
                            <br>
                            <div class="form-group">
                                {{ Form::label('doc_project_file', 'Upload Project Documentation') }} 
                                {{ Form::file('fileDoc') }}<span class="error">{{ $errors->first('fileDoc') }}</span>
                            </div>
                            <div class="form-group">
                                {{ Form::hidden('user_created', Sentry::getUser()->id, array('class' => 'col-lg-12 form-control')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
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
                        $('#sApps').on('change', function(){
                            $.post('{{ URL::to('project/new') }}', {type: 'modul', id: $('#sApps').val()}, function(e){
                                $('#sModul').html(e);
                            });
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>
@stop