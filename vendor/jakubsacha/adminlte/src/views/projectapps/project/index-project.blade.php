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
                {{ Form::open(array('url' => 'projects')) }}
                <div class="col-lg-6">
                    <div class="form-group">
                        {{ Form::label('projectNameSearch', 'Project Name') }}
                        {{ Form::text('projectNameSearch', null, array('id' => 'projectNameSearch', 'class' => 'col-lg-12 form-control')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('referenceNoSearch', 'Reference') }}
                        {{ Form::text('referenceNoSearch', null, array('id' => 'referenceNoSearch', 'class' => 'col-lg-12 form-control')) }}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        {{ Form::label('requestUserSearch', 'User Request') }}
                        {{ Form::text('requestUserSearch', null, array('id' => 'requestUserSearch', 'class' => 'col-lg-12 form-control')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('statusSearch', 'Project Status') }}
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
                <h3 class="box-title">List of Application Project</h3>
                    <p class="pull-right">
                        @if($currentUser->hasAccess('create-project'))
                        <a class="btn btn-app" href="{{ URL::route('newProject') }}">
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
                @include('adminlte::projectapps.project.list-project')
            </div>
        </div>
    </div>
</div>


@stop