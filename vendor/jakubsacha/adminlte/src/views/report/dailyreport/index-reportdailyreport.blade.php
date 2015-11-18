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
                    {{ Form::open(array('url' => 'searchdailyreports')) }}
                        <div class="col-lg-4">
                            <div class="form-group">
                                {{ Form::label('tasklistSearch', 'Tasklist') }}
                                {{ Form::select('tasklistSearch', $tasklists, 'Choose Tasklist', array('id' => 'tasklistSearch', 'class' => 'col-lg-12 form-control'))  }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('referenceSearch', 'Reference') }}
                                {{ Form::select('referenceSearch', $projectNames, 'Choose Project', array('id' => 'referenceSearch', 'class' => 'col-lg-12 form-control'))  }}
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                {{ Form::label('targetFinishSearch', 'target Finish') }}
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="span2 col-lg-6 form-control" value id="datetimepicker" data-format="yyyy-mm-dd hh:ii:ss" name="targetFinishSearch" placeholder="click here"/>
                                </div><!-- /.input group -->
                            </div>
                            <div class="form-group">
                                {{ Form::label('actualFinishDateSearch', 'Actual Finish Date') }}
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="span2 col-lg-6 form-control" value id="datetimepicker2" data-format="yyyy-mm-dd hh:ii:ss" name="actualFinishDateSearch" placeholder="click here"/>
                                </div><!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-lg-4">
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
                    <h3 class="box-title">Job Daily Report</h3>
                    <p class="pull-right">
                            @if($currentUser->hasAccess('create-tasklist'))
                            <a class="btn btn-app" href="{{ URL::route('exportPDFDailyReports') }}">
                                <i class="fa fa-file"></i> Export PDF
                            </a>
                            @endif
                    </p>
                </div>
                <div class="box-body  ajax-content no-padding">
                    @include('adminlte::report.dailyreport.list-reportdailyreport')
                </div>
            </div>
        </div>
    </div>


@stop