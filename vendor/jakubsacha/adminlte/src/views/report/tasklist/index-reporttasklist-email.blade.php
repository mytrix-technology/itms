@extends(Config::get('adminlte::views.master'))

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Tasklist Report - Autoemail</h3>
                        <p class="pull-right">
                        	
                        </p>
                </div>
                <div class="box-body  ajax-content no-padding">
                    @include('adminlte::report.tasklist.list-reporttasklist-email')
                </div>
            </div>
        </div>
    </div>


@stop