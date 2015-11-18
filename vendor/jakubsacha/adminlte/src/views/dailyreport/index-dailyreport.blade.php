@extends(Config::get('adminlte::views.master'))

@section('content')
<script src="{{ asset('packages/mrjuliuss/syntara/assets/js/dashboard/user.js') }}"></script>

@include('syntara::layouts.dashboard.confirmation-modal', array('title' => trans('syntara::all.confirm-delete-title'), 'content' => trans('syntara::all.confirm-delete-message'), 'type' => 'delete-user'))

<div class="row">
    <div class="col-lg-12">
            <div class="box box-warning">
                <div class="box-header">
                    <h3 class="box-title">Search</h3>
                </div>
                <div class="box-body">
                    {{ Form::open(array('url' => 'dailyreports')) }}
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
                                    <input type="text" class="span2 col-lg-6 form-control" value id="datepicker" data-date-format="yyyy-mm-dd" name="targetFinishSearch" placeholder="click here"/>
                                </div><!-- /.input group -->
                            </div>
                            <div class="form-group">
                                {{ Form::label('actualFinishDateSearch', 'Actual Finish Date') }}
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="span2 col-lg-6 form-control" value id="datepicker1" data-date-format="yyyy-mm-dd" name="actualFinishDateSearch" placeholder="click here"/>
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
                <button class="btn btn-warning btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">List of Job Daily Report</h3>
                <div class="box-tools">
                    <p class="pull-right">
                        
                    </p>
                </div>
            </div>
            <div class="box-body  ajax-content no-padding">
                @include('adminlte::dailyreport.list-dailyreport')
            </div>
        </div>
    </div>
</div>


@stop