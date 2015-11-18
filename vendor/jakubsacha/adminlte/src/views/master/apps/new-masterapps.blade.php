@extends(Config::get('adminlte::views.master'))

@section('content')
<script src="{{ asset('packages/mrjuliuss/syntara/assets/js/dashboard/masterapps.js') }}"></script>
<div class="row">
    <div class="col-lg-12">
        <div class="box box-primary">
            <div class="box-header">
                <h1 class="box-title">New Application Master</h1>
            </div>
            <div class="box-body">
                {{ Form::open(array('url' => 'masterapps/new', 'id' => 'create-masterapps-form')) }}
                    @if(Sentry::check())
                    <div class="row-fluid">
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('name_apps', 'Application Name') }} <span class="error">{{ $errors->first('name_apps') }}</span>
                                {{ Form::text('name_apps', Input::old('name_apps'), array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('desc_apps', 'Application Description') }} <span class="error">{{ $errors->first('desc_apps') }}</span>
                                {{ Form::textarea('desc_apps', Input::old('desc_apps'), array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                <label class="control-label">Build Date</label>
                                <p>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="span2 col-lg-6 form-control" value id="datetimepicker" data-format="yyyy-mm-dd hh:ii:ss" name="datepicker" placeholder="click here"/>
                                    </div><!-- /.input group -->
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('version', 'Version') }} <span class="error">{{ $errors->first('version') }}</span>
                                {{ Form::text('version', Input::old('version'), array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('note', 'Note') }} <span class="error">{{ $errors->first('note') }}</span>
                                {{ Form::textarea('note', Input::old('note'), array('class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::hidden('development_by', Sentry::getUser()->id, array('class' => 'col-lg-12 form-control')) }}
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