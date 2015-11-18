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
                {{ Form::model($projects, array('route' => array('putProject', $projects->id), 'method' => 'PUT', 'files' => true)) }}
                    @if(Sentry::check())
                    <div class="row-fluid">
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('name_project', 'Project Name') }} (* <span class="error">{{ $errors->first('name_project') }}</span>
                                {{ Form::text('name_project', $projects->name_project, array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('desc_project', 'Project Description') }} (* <span class="error">{{ $errors->first('desc_project') }}</span>
                                {{ Form::textarea('desc_project', $projects->desc_project, array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                <label class="control-label">Due Date</label> (*
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="span2 col-lg-6 form-control" value='{{ $projects->due_date }}' id="datetimepicker" data-format="yyyy-mm-dd hh:ii:ss" name="datepicker" placeholder="click here"/>
                                </div><!-- /.input group -->
                            </div>
                            <div class="form-group">
                                {{ Form::label('status_project_request', 'Project Status') }} (* <span class="error">{{ $errors->first('status_project_request') }}</span>
                                {{ Form::select('status_project_request', array('default' => $projects->masterstatus->group.' - '.$projects->masterstatus->status_name) + $masterstatuss, $projects->status_project_request, array('id' => 'status_project_request', 'class' => 'col-lg-12 form-control',Input::old('status_project_request')))  }}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('master_type_project_id', 'Project Type Master') }} (* <span class="error">{{ $errors->first('master_type_project_id') }}</span>
                                {{ Form::select('master_type_project_id', array('default' => $projects->masterprojecttype->name_project_type) + $masterprojecttypes, $projects->master_type_project_id, array('id' => 'master_type_project_id', 'class' => 'col-lg-12 form-control',Input::old('master_type_project_id')))  }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('reference', 'Reference Number') }} 
                                {{ Form::text('reference', $projects->reference, array('id' => 'reference','class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('user_request', 'User Request') }} (* <span class="error">{{ $errors->first('user_request') }}</span>
                                {{ Form::text('user_request', $projects->user_request, array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('master_apps_id', 'Application Master') }} 
                                @if($projects->master_apps_id == null)
                                    {{ Form::select('apps', $masterappss, 'Choose Application Master', array('id' => 'sApps', 'class' => 'col-lg-12 form-control'))  }}
                                @else
                                    {{ Form::select('apps', array('default' => $projects->masterapps->name_apps) + $masterappss, $projects->master_apps_id, array('id' => 'sApps', 'class' => 'col-lg-12 form-control'))  }}
                                @endif
                            </div>
                            <div class="form-group">
                                {{ Form::label('master_modul_id', 'Modul Master') }} 
                                @if($projects->master_modul_id == null)
                                    {{ Form::select('modul', array(), null, array('id' => 'sModul', 'class' => 'col-lg-12 form-control'))  }}
                                @else
                                    {{ Form::select('modul', array('default' => $projects->mastermodul->name_modul) + $mastermoduls, $projects->master_modul_id, array('id' => 'sModul', 'class' => 'col-lg-12 form-control'))  }}
                                @endif
                            </div>
                            <div class="form-group">
                                {{ Form::label('doc_project_file', 'Project Documentation File') }} 
                                {{ Form::file('fileDoc') }}
                                {{ Form::hidden('doc_project_file', $projects->doc_project_file) }}
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