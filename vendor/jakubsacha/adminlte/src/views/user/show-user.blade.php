@extends(Config::get('syntara::views.master'))

@section('content')

<script src="{{ asset('packages/mrjuliuss/syntara/assets/js/dashboard/user.js') }}"></script>
<div class="row">
    <div class="col-lg-8">
        <div class="box box-primary">
            <div class="box-body clearfix">
                <form class="form" id="edit-user-form" method="PUT" files="TRUE">
                    <div class="row-fluid">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">{{ trans('syntara::users.username') }}</label> (*
                                <input class="col-lg-12 form-control" type="text" id="username" name="username" value="{{ $user->username}}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ trans('syntara::all.email') }}</label> (*
                                <input class="col-lg-12 form-control" type="text" id="email" name="email" value="{{ $user->email }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ trans('syntara::all.password') }}</label> (*
                                <input class="col-lg-12 form-control" type="password" placeholder="{{ trans('syntara::all.password') }}" id="pass" name="pass" >
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ trans('syntara::users.last-name') }}</label> (*
                                <input class="col-lg-12 form-control" type="text" id="last_name" name="last_name" value="{{ $user->last_name  }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ trans('syntara::users.first-name') }}</label> (*
                                <input class="col-lg-12 form-control" type="text" id="first_name" name="first_name" value="{{ $user->first_name }}">
                            </div>
                            <br><br>
                            <div class="form-group">
                                <label class="control-label">{{ trans('syntara::users.groups') }}</label>
                            </div>
                            <div class="form-group">
                                @foreach($groups as $group)
                                <label class="checkbox">
                                    @if($currentUser->hasAccess('user-group-management'))
                                    <input type="checkbox" id="groups[{{ $group->getId() }}]" name="groups[]" value="{{ $group->getId() }}" {{ ($user->inGroup($group)) ? 'checked="checked"' : ''}}>
                                    @endif
                                    {{ $group->getName() }}
                                </label>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('image', 'Upload Picture') }} <span class="error">{{ $errors->first('image') }}</span>
                                {{ Form::file('fileProfile') }}
                                {{ Form::hidden('image', $user->image) }}
                            </div>
                            <div class="form-group">
                                @if($currentUser->hasAccess('permissions-management'))
                                @include('syntara::layouts.dashboard.permissions-select', array('permissions'=> $permissions))
                                @endif
                            </div>
                            @if($user->getId() !== $currentUser->getId())
                            <div class="form-group">
                                <label class="control-label">{{ trans('syntara::users.banned') }} : </label>
                                <input id="no" name="banned" type="radio" value="no" {{ ($throttle->isBanned() === false) ? 'checked' : '' }}>
                                <label for="no" onclick="">{{ trans('syntara::all.no') }}</label>

                                <input id="yes" name="banned" type="radio" value="yes" {{ ($throttle->isBanned() === true) ? 'checked' : '' }}>
                                <label for="yes" onclick="">{{ trans('syntara::all.yes') }}</label>

                            </div>
                            @endif
                            @if($user->getId() !== $currentUser->getId())
                            <div class="form-group">
                                <label class="control-label">Suspended : </label>
                                <input id="no" name="suspended" type="radio" value="no" {{ ($throttle->isSuspended() === false) ? 'checked' : '' }}>
                                <label for="no" onclick="">{{ trans('syntara::all.no') }}</label>

                                <input id="yes" name="suspended" type="radio" value="yes" {{ ($throttle->isSuspended() === true) ? 'checked' : '' }}>
                                <label for="yes" onclick="">{{ trans('syntara::all.yes') }}</label>

                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="col-lg-12">
                            <br>
                            <div class="pull-right">
                                <button id="update-user" class="btn btn-primary">{{ trans('syntara::all.update') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="box box-warning">
            <div class="box-header">
                <h3 class="box-title">{{ trans('syntara::users.information') }}</h3>
            </div>
            <div class="box-body ajax-content">
                @include('syntara::user.user-informations')
            </div>
        </div>
    </div>
</div>
@stop