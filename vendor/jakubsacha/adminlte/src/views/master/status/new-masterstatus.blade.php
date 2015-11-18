@extends(Config::get('adminlte::views.master'))

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="box box-primary">
            <div class="box-header">
                <h1 class="box-title">Master Status Baru</h1>
            </div>
            <div class="box-body">
                <?php if(Session::has('register_success')): ?>
                    <div class="message message-success">
                        <span class="close"></span>
                        <?php echo Session::get('register_success') ?>
                    </div>
                <?php endif; ?>
                {{ Form::open(array('url' => 'masterstatus/new')) }}
                    @if(Sentry::check())
                    <div class="row-fluid">
                        <div class="col-lg-12">
                            <div class="form-group">
                                {{ Form::label('group', 'Group') }} <span class="error">{{ $errors->first('group') }}</span>
                                {{ Form::text('group', Input::old('group'), array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('status_name', 'Nama Status') }} <span class="error">{{ $errors->first('status_name') }}</span>
                                {{ Form::text('status_name', Input::old('status_name'), array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('status_desc', 'Dekripsi Status') }} <span class="error">{{ $errors->first('status_desc') }}</span>
                                {{ Form::text('status_desc', Input::old('status_desc'), array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <br><br>
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