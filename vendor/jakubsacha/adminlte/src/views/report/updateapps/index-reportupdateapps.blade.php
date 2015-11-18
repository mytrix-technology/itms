@extends(Config::get('adminlte::views.master'))

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-warning collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">Search</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div><!-- /.box-tools -->
                </div>
                <div class="box-body">
                    {{ Form::open(array('url' => 'searchupdateappss')) }}
                        <div class="col-lg-3">
                            <div class="form-group">
                                {{ Form::label('appsMasterSearch', 'Application Master') }}
                                {{ Form::select('appsMasterSearch', $masterappss, 'Choose Application Master', array('id' => 'appsMasterSearch', 'class' => 'col-lg-12 form-control'))  }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('modulMasterSearch', 'Modul Master') }}
                                {{ Form::select('modulMasterSearch', $mastermoduls, 'Choose Modul Master', array('id' => 'modulMasterSearch', 'class' => 'col-lg-12 form-control'))  }}
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                {{ Form::label('databaseChangeSearch', 'Database Change') }}
                                {{ Form::text('databaseChangeSearch', null, array('id' => 'databaseChangeSearch', 'class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('appsChangeSearch', 'Application Change') }}
                                {{ Form::text('appsChangeSearch', null, array('id' => 'appsChangeSearch', 'class' => 'col-lg-12 form-control')) }}
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                {{ Form::label('appsVersionSearch', 'Application Version') }}
                                {{ Form::text('appsVersionSearch', null, array('id' => 'appsVersionSearch', 'class' => 'col-lg-12 form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('userRequestSearch', 'User Request') }}
                                {{ Form::select('userRequestSearch', $users, 'Choose User', array('id' => 'userRequestSearch', 'class' => 'col-lg-12 form-control'))  }}
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                {{ Form::label('updateDateSearch', 'Update Date') }}
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="span2 col-lg-6 form-control" value id="datetimepicker" data-format="yyyy-mm-dd hh:ii:ss" name="updateDateSearch" placeholder="click here"/>
                                </div><!-- /.input group -->
                            </div>
                            <div class="form-group">
                                {{ Form::label('statusSearch', 'Status') }}
                                {{ Form::select('statusSearch', $masterstatuss, 'Choose Status', array('id' => 'statusSearch', 'class' => 'col-lg-12 form-control'))  }}
                            </div>
                        </div>
                        {{ Form::submit('Search', array('class' => 'btn btn-primary', 'style' => 'margin-top: 15px;')) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Application Update Report</h3>
                    <div class="box-tools">
                        <p class="pull-right">

                        </p>
                    </div>
                </div>
                <div class="box-body  ajax-content no-padding">
                    @include('adminlte::report.updateapps.list-reportupdateapps')
                </div>
            </div>
        </div>
    </div>


@stop