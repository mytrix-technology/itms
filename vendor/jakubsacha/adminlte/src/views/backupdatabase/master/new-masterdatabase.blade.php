@extends(Config::get('adminlte::views.master'))

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="box box-primary">
                <div class="box-header">
                    <h1 class="box-title">New Database Master</h1>
                </div>
                <div class="box-body">
                    <?php if(Session::has('register_success')): ?>
                    <div class="message message-success">
                        <span class="close"></span>
                        <?php echo Session::get('register_success') ?>
                    </div>
                    <?php endif; ?>
                    {{ Form::open(array('url' => 'masterDB/new')) }}
                    @if(Sentry::check())
                        <div class="row-fluid">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    {{ Form::label('server_name', 'Server Name') }} <span class="error">{{ $errors->first('server_name') }}</span>
                                    {{ Form::text('server_name', Input::old('server_name'), array('class' => 'col-lg-12 form-control')) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('database_name', 'Database Name') }} <span class="error">{{ $errors->first('database_name') }}</span>
                                    {{ Form::text('database_name', Input::old('database_name'), array('class' => 'col-lg-12 form-control')) }}
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
                </div>
            </div>
        </div>
    </div>
@stop