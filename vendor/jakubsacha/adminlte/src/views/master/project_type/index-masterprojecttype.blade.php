@extends(Config::get('adminlte::views.master'))

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
                {{ Form::open(array('url' => 'masterprojecttypes')) }}
                <div class="col-lg-6">
                    <div class="form-group">
                        {{ Form::label('projectTypeNameSearch', 'Name') }}
                        {{ Form::text('projectTypeNameSearch', null, array('id' => 'projectTypeNameSearch', 'class' => 'col-lg-12 form-control')) }}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        {{ Form::label('activatedSearch', 'Activated') }}
                        {{ Form::select('activatedSearch', array('1' => 'Active', '0' => 'Non Active'),'0', array('id' => 'activatedSearch', 'class' => 'col-lg-12 form-control')) }}
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
                <h3 class="box-title">List of Project Type Master</h3>
                    <p class="pull-right">
                        @if($currentUser->hasAccess('create-masterprojecttype'))
                        <a class="btn btn-app" href="{{ URL::route('newMasterProjectType') }}">
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
                @include('adminlte::master.project_type.list-masterprojecttype')
            </div>
        </div>
    </div>
</div>


@stop