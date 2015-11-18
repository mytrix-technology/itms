<table id="example" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="col-lg-1" style="text-align: center;">#</th>
            @if($currentUser->hasAccess('permissions-management'))
            <th class="col-lg-1" style="text-align: center;"><input type="checkbox" class="check-all"></th>
            @endif
            <th class="col-lg-2">{{ trans('syntara::all.name') }}</th>
            <th class="col-lg-2">{{ trans('syntara::permissions.value') }}</th>
            <th>{{ trans('syntara::permissions.description') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($permissions as $permission)
        <tr <?php if ($currentUser->hasAccess('permissions-management')): ?> onclick="location.href ='{{ URL::route('showPermission', $permission->getId()) }}'" <?php endif; ?>>
            <td style="text-align: center;"></td>
            @if($currentUser->hasAccess('permissions-management'))
            <td style="text-align: center;">
                <input type="checkbox" data-permission-id="{{ $permission->getId(); }}">
            </td>
            @endif
            <td>&nbsp;{{ $permission->getName() }}</td>
            <td>&nbsp;{{ $permission->getValue() }}</td>
            <td>&nbsp;{{ $permission->getDescription() }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="box-footer">
    
</div>