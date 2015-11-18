@extends(Config::get('syntara::views.master'))

@section('content')
<script src="{{ asset('packages/mrjuliuss/syntara/assets/js/dashboard/user.js') }}"></script>

@include('syntara::layouts.dashboard.confirmation-modal', array('title' => trans('syntara::all.confirm-delete-title'), 'content' => trans('syntara::all.confirm-delete-message'), 'type' => 'delete-user'))

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
                <form id="search-form"  onsubmit="return false;">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="userIdSearch">{{ trans('syntara::users.id') }}</label>
                        <input type="text" class="form-control" id="userIdSearch" name="userIdSearch">
                    </div>
                    <div class="form-group">
                        <label for="usernameSearch">{{ trans('syntara::users.username') }}</label>
                        <input type="text" class="form-control" id="usernameSearch" name="usernameSearch">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="emailSearch">{{ trans('syntara::all.email') }}</label>
                        <input type="email" class="form-control" id="emailSearch" name="emailSearch">
                    </div>
                    <div class="form-group">
                        <label for="bannedSearch">{{ trans('syntara::users.banned') }}</label>
                        <select class="form-control" id="bannedSearch" name="bannedSearch">
                            <option>--</option>
                            <option value="0">{{ trans('syntara::all.no') }}</option>
                            <option value="1">{{ trans('syntara::all.yes') }}</option>
                        </select>
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
                <h3 class="box-title">{{ trans('syntara::users.all') }}</h3>
                    <p class="pull-right">
                        @if($currentUser->hasAccess('delete-user'))
                        <a id="delete-item" class="btn btn-app">
                            <i class="fa fa-eraser"></i> {{ trans('syntara::all.delete') }}
                        </a>
                        @endif

                        @if($currentUser->hasAccess('create-user'))
                        <a class="btn btn-app" href="{{ URL::route('newUser') }}">
                            <i class="fa fa-plus"></i> {{ trans('syntara::users.new') }}
                        </a>
                        @endif
                    </p>
                
            </div>
            <div class="box-body  ajax-content no-padding">
                @include('adminlte::user.list-users')
            </div>
        </div>
    </div>
</div>


@stop