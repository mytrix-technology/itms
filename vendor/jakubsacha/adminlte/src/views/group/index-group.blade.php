@extends(Config::get('adminlte::views.master'))

@section('content')
<script src="{{ asset('packages/mrjuliuss/syntara/assets/js/dashboard/group.js') }}"></script>

@include('syntara::layouts.dashboard.confirmation-modal',  array('title' => trans('syntara::all.confirm-delete-title'), 'content' => trans('syntara::all.confirm-delete-message'), 'type' => 'delete-group'))

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
                <form id="search-form" onsubmit="return false;">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="groupIdSearch">{{ trans('syntara::groups.id') }}</label>
                        <input type="text" class="form-control" id="groupIdSearch" name="groupIdSearch">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="groupnameSearch">{{ trans('syntara::groups.name') }}</label>
                        <input type="text" class="form-control" id="groupnameSearch" name="groupnameSearch">
                    </div>
                </div>
                    <button type="submit" class="btn btn-primary">{{ trans('syntara::all.search') }}</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{ trans('syntara::groups.all') }}</h3>

                    <div class="pull-right">
                        <a id="delete-item" class="btn btn-app groups">
                            <i class="fa fa-eraser"></i> {{ trans('syntara::all.delete') }}
                        </a>
                        <a class="btn btn-app" href="{{ URL::route('newGroup') }}">
                            <i class="fa fa-plus"></i> {{ trans('syntara::groups.new') }}
                        </a>
                    </div>
                
            </div>
            <div class="box-body ajax-content no-padding">
                @include('adminlte::group.list-groups')
            </div>
        </div>
    </div>

</div>
@stop