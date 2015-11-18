@extends(Config::get('adminlte::views.master'))

@section('content')
<script src="{{ asset('packages/mrjuliuss/syntara/assets/js/dashboard/user.js') }}"></script>

@include('syntara::layouts.dashboard.confirmation-modal', array('title' => trans('syntara::all.confirm-delete-title'), 'content' => trans('syntara::all.confirm-delete-message'), 'type' => 'delete-user'))

<div class="row">
    <div class="col-lg-10">
        <div class="box box-warning">
            <div class="box-header">
                <h3 class="box-title">Pencarian</h3>
            </div>
            <div class="box-body">
                <form id="search-form"  onsubmit="return false;">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="userIdSearch">Nama Aplikasi</label>
                            <input type="text" class="form-control" id="userIdSearch" name="userIdSearch">
                        </div>
                        <div class="form-group">
                            <label for="usernameSearch">Staff</label>
                            <input type="text" class="form-control" id="usernameSearch" name="usernameSearch">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="emailSearch">Tgl Upload</label>
                            <input type="email" class="form-control" id="emailSearch" name="emailSearch">
                        </div>
                        <div class="form-group">
                            <label for="emailSearch">No Form Design</label>
                            <input type="email" class="form-control" id="emailSearch" name="emailSearch">
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
                <h3 class="box-title">Detail Desain Aplikasi</h3>
                <div class="box-tools">
                    <p class="pull-right">
                        @if($currentUser->hasAccess('create-design-detail'))
                        <a class="btn btn-info btn-new btn-sm" href="{{ URL::route('newDesign') }}">Desain Aplikasi Baru</a>
                        @endif
                    </p>
                </div>
            </div>
            <div class="box-body  ajax-content no-padding">
                <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="col-lg-1 hidden-xs" style="text-align: center;">#</th>
                        <th class="col-lg-1">Nama Aplikasi</th>
                        <th class="col-lg-1">Nama Staff</th>
                        <th class="col-lg-1">Tgl Upload</th>
                        <th class="col-lg-1 hidden-xs">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($designs->count())
                    @foreach ($designs as $design)
                    
                    <tr>
                        <td class="hidden-xs" style="text-align: center;">{{ $design->getId() }}</td>
                        <td>&nbsp;{{ $design->getNamaUser() }}</td>
                        <td class="visible-lg">&nbsp;{{ $design->getFilePath() }}</td>
                        <td class="visible-lg">&nbsp;{{ $design->getCreatedAt() }}</td>
                        <td class="visible-lg">
                            <!-- Detail Design -->
                            <p> <a class="btn btn-small btn-info" href="{{ URL::route('showTask', $vendor->getId()) }}">Ubah</a> </p>
                            
                            <!-- Edit vendor -->
                            <p> <a class="btn btn-small btn-info" href="{{ URL::route('showDesign', $vendor->getId()) }}">Ubah</a> </p>
                            
                            <!-- Delete vendor -->
                            <p>
                            {{ Form::open(array('method'=>'DELETE', 'route'=>array('deleteDesign', $vendor->id), 'class' => 'pull-right')) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
                            {{ Form::close() }}
                            </p>
                        </td>
                        
                    </tr>
                    @endforeach
                    @else
                        <tr><td colspan="10" align="center">
                        Data tidak ditemukan!
                        </td></tr>
                    @endif
                </tbody>
            </table>
            
            <div class="box-footer">
                {{ $designs->links(); }}
            </div>
            </div>
        </div>
    </div>
</div>


@stop