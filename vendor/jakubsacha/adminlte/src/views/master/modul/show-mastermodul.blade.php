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
                {{ Form::model($mastermoduls, array('route' => array('putMasterModul', $mastermoduls->id), 'method' => 'PUT')) }}
                    @if(Sentry::check())
                    <div class="row-fluid">
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('name_modul', 'Modul Name') }} <span class="error">{{ $errors->first('name_modul') }}</span>
                                {{ Form::text('name_modul', $mastermoduls->name_modul, array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('master_apps_id', 'Application Name') }} <span class="error">{{ $errors->first('master_apps_id') }}</span>
                                {{ Form::select('master_apps_id', array('default' => $mastermoduls->masterapps->name_apps) + $masterappss, $mastermoduls->master_apps_id, array('id' => 'master_apps_id', 'class' => 'col-lg-12 form-control', Input::old('master_apps_id')))  }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('activated', 'Activated') }}
                                {{ Form::radio('activated', 1) }}&nbsp;&nbsp;{{ Form::label('yes', 'Yes') }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                {{ Form::radio('activated', 0) }}&nbsp;&nbsp;{{ Form::label('no', 'No') }}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('desc_modul', 'Modul Description') }} <span class="error">{{ $errors->first('desc_modul') }}</span>
                                {{ Form::textarea('desc_modul', $mastermoduls->desc_modul, array('class' => 'col-lg-12 form-control')) }}
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