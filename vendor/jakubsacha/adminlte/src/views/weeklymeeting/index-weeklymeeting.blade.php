@extends(Config::get('adminlte::views.master'))

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="box box-warning collapsed-box">
            <div class="box-header with-border">
                <h3 class="box-title">Search</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                </div><!-- /.box-tools -->
            </div>
                <div class="box-body">
                    {{ Form::open(array('url' => 'weeklymeetings')) }}
                            <div class="form-group">
                                {{ Form::label('weeklyMeetingDateSearch', 'Weekly Meeting Date') }}
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="span2 col-lg-6 form-control" value id="datetimepicker" data-format="yyyy-mm-dd hh:ii:ss" name="weeklyMeetingDateSearch" placeholder="click here"/>
                                </div><!-- /.input group -->
                            </div>
                        {{ Form::submit('Search', array('class' => 'btn btn-primary', 'style' => 'margin-top: 15px;')) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Weekly Meeting</h3>
                    <p class="pull-right">
                        @if($currentUser->hasAccess('create-weeklymeeting'))
                        <a class="btn btn-app" href="{{ URL::route('newWeeklyMeeting') }}">
                            <i class="fa fa-plus"></i> New
                        </a>
                        @endif
                    </p>
                
            </div>
            <div class="box-body  ajax-content no-padding">
                {{ Notification::showAll() }}
                
                @if ($errors->any())
                    <div class="alert alert-error">
                        {{ implode('<br>', $errors->all()) }}
                    </div>
                @endif
                @include('adminlte::weeklymeeting.list-weeklymeeting')
            </div>
        </div>
    </div>
</div>


@stop