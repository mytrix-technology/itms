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
                    {{ Form::open(array('url' => 'searchuats')) }}
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('projectNameSearch', 'Project Name') }}
                                {{ Form::select('projectNameSearch', $projectNames, 'Choose Project', array('id' => 'projectNameSearch', 'class' => 'col-lg-12 form-control'))  }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('actualUATDateSearch', 'Actual UAT Date') }}
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="span2 col-lg-6 form-control" value id="datetimepicker" data-format="yyyy-mm-dd hh:ii:ss" name="actualUATDateSearch" placeholder="click here"/>
                                </div><!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('userUATSearch', 'User UAT') }}
                                {{ Form::select('userUATSearch', $users, 'Choose User', array('id' => 'userUATSearch', 'class' => 'col-lg-12 form-control'))  }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('revisionSearch', 'Revision') }}
                                {{ Form::text('revisionSearch', null, array('id' => 'revisionSearch', 'class' => 'col-lg-12 form-control')) }}
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
                    <h3 class="box-title">User Accept Test Report</h3>
                    <div class="box-tools">
                        <p class="pull-right">

                        </p>
                    </div>
                </div>
                <div class="box-body  ajax-content no-padding">
                    @include('adminlte::report.uat.list-reportuat')
                </div>
            </div>
        </div>
    </div>


@stop