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
                    {{ Form::model($masterDBs, array('route' => array('putMasterDB', $masterDBs->id), 'method' => 'PUT')) }}
                    @if(Sentry::check())
                        <div class="row-fluid">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    {{ Form::label('server_name', 'Server Name') }} <span class="error">{{ $errors->first('server_name') }}</span>
                                    {{ Form::text('server_name', $masterDBs->server_name, array('class' => 'col-lg-12 form-control')) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('database_name', 'Database Name') }} <span class="error">{{ $errors->first('database_name') }}</span>
                                    {{ Form::text('database_name', $masterDBs->database_name, array('class' => 'col-lg-12 form-control')) }}
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