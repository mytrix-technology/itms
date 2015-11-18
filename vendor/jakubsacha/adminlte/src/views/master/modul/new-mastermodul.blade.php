@extends(Config::get('adminlte::views.master'))

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box box-primary">
            <div class="box-header">
                <h1 class="box-title">Master Modul Baru</h1>
            </div>
            <div class="box-body">
                <?php if(Session::has('register_success')): ?>
                    <div class="message message-success">
                        <span class="close"></span>
                        <?php echo Session::get('register_success') ?>
                    </div>
                <?php endif; ?>
                {{ Form::open(array('url' => 'mastermodul/new')) }}
                    @if(Sentry::check())
                    <div class="row-fluid">
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('name_modul', 'Modul Name') }} <span class="error">{{ $errors->first('name_modul') }}</span>
                                {{ Form::text('name_modul', Input::old('name_modul'), array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('master_apps_id', 'Application Name') }} <span class="error">{{ $errors->first('master_apps_id') }}</span>
                                {{ Form::select('master_apps_id', $masterappss, 'Choose Master Application', array('id' => 'master_apps_id', 'class' => 'col-lg-12 form-control'))  }}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('desc_modul', 'Modul Description') }} <span class="error">{{ $errors->first('desc_modul') }}</span>
                                {{ Form::textarea('desc_modul', Input::old('desc_modul'), array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::hidden('user_created', Sentry::getUser()->id, array('class' => 'col-lg-12 form-control')) }}
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