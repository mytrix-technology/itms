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
                {{ Form::model($masterprojecttypes, array('route' => array('putMasterProjectType', $masterprojecttypes->id), 'method' => 'PUT')) }}
                    @if(Sentry::check())
                    <div class="row-fluid">
                        <div class="col-lg-10">
                            <div class="form-group">
                                {{ Form::label('name_project_type', 'Nama Tipe Proyek') }} <span class="error">{{ $errors->first('name_project_type') }}</span>
                                {{ Form::text('name_project_type', $masterprojecttypes->name_project_type, array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('desc_project_type', 'Deskripsi Tipe Proyek') }} <span class="error">{{ $errors->first('desc_project_type') }}</span>
                                {{ Form::text('desc_project_type', $masterprojecttypes->desc_project_type, array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('activated', 'Activated') }}
                                {{ Form::radio('activated', 1) }}&nbsp;&nbsp;{{ Form::label('yes', 'Yes') }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                {{ Form::radio('activated', 0) }}&nbsp;&nbsp;{{ Form::label('no', 'No') }}
                            </div>
                            <div class="form-group">
                                {{ Form::hidden('user_updated', Sentry::getUser()->id, array('class' => 'col-lg-12 form-control')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="col-lg-10">
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