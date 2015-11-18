@extends(Config::get('adminlte::views.master'))

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box box-primary">
            <div class="box-header">
                <h1 class="box-title">Master Tipe Tugas Baru</h1>
            </div>
            <div class="box-body">
                <?php if(Session::has('register_success')): ?>
                    <div class="message message-success">
                        <span class="close"></span>
                        <?php echo Session::get('register_success') ?>
                    </div>
                <?php endif; ?>
                {{ Form::open(array('url' => 'mastertasktype/new')) }}
                @if(Sentry::check())
                    <div class="row-fluid">
                        <div class="col-lg-10">
                            <div class="form-group">
                                {{ Form::label('name_task_type', 'Nama Tipe Tugas') }} <span class="error">{{ $errors->first('name_task_type') }}</span>
                                {{ Form::text('name_task_type', Input::old('name_task_type'), array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('desc_task_type', 'Deskripsi Tipe Tugas') }} <span class="error">{{ $errors->first('desc_task_type') }}</span>
                                {{ Form::text('desc_task_type', Input::old('desc_task_type'), array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('activated', 'Activated') }}
                                {{ Form::radio('activated', 1) }}&nbsp;&nbsp;{{ Form::label('yes', 'Yes') }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                {{ Form::radio('activated', 0) }}&nbsp;&nbsp;{{ Form::label('no', 'No') }}
                            </div>
                            <div class="form-group">
                                {{ Form::hidden('user_created', Sentry::getUser()->id, array('class' => 'col-lg-12 form-control')) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
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